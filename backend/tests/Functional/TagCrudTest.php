<?php

namespace App\Tests\Functional;

final class TagCrudTest extends ApiTestCase
{
    public function testTagCrudRegression(): void
    {
        $this->client->request('GET', sprintf('/api/tag/%d', $this->tag->getId()));
        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('title', 'Seed Tag');

        $this->client->request('GET', '/api/tag');
        self::assertResponseStatusCodeSame(200);
        self::assertIsArray($this->responseData());

        $this->jsonRequest('POST', '/api/tag', ['title' => 'Created Tag']);
        self::assertResponseStatusCodeSame(401);

        $this->loginAsAdmin();

        $this->jsonRequest('POST', '/api/tag', []);
        self::assertResponseStatusCodeSame(400);

        $this->assertGetNotFound('/api/tag/999999');

        $this->jsonRequest('POST', '/api/tag', ['title' => 'Created Tag']);
        self::assertResponseStatusCodeSame(201);
        $created = $this->responseData();
        self::assertSame('Created Tag', $created['title']);

        $createdId = $created['id'];

        $this->client->request('GET', sprintf('/api/tag/%d', $createdId));
        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('title', 'Created Tag');

        $this->jsonRequest('PATCH', sprintf('/api/tag/%d', $createdId), ['title' => 'Updated Tag']);
        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('title', 'Updated Tag');

        $this->jsonRequest('DELETE', sprintf('/api/tag/%d', $createdId));
        self::assertResponseStatusCodeSame(204);

        $this->assertGetNotFound(sprintf('/api/tag/%d', $createdId));
    }
}
