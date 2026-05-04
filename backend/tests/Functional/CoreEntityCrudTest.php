<?php

namespace App\Tests\Functional;

final class CoreEntityCrudTest extends ApiTestCase
{
    public function testGameCrudRegression(): void
    {
        $this->assertCoreCrud('game', $this->game->getId(), $this->gamePayload('Created Game'), $this->gamePayload('Updated Game'));
    }

    public function testNewsCrudRegression(): void
    {
        $this->assertCoreCrud('news', $this->news->getId(), $this->newsPayload('Created News'), $this->newsPayload('Updated News'));
    }

    public function testReviewCrudRegression(): void
    {
        $this->assertCoreCrud('review', $this->review->getId(), $this->reviewPayload('Created Review'), $this->reviewPayload('Updated Review'));
    }

    private function assertCoreCrud(string $entityName, int $seedId, array $createPayload, array $updatePayload): void
    {
        $this->client->request('GET', sprintf('/api/%s/%d', $entityName, $seedId));
        self::assertResponseStatusCodeSame(200);
        self::assertArrayHasKey('id', $this->responseData());

        $this->client->request('GET', '/api/' . $entityName);
        self::assertResponseStatusCodeSame(200);
        self::assertArrayHasKey('items', $this->responseData());

        $this->jsonRequest('POST', '/api/' . $entityName, $createPayload);
        self::assertResponseStatusCodeSame(401);

        $this->loginAsAdmin();

        $invalidPayload = $createPayload;
        unset($invalidPayload['title']);
        $this->jsonRequest('POST', '/api/' . $entityName, $invalidPayload);
        self::assertResponseStatusCodeSame(400);

        $this->assertGetNotFound(sprintf('/api/%s/%d', $entityName, 999999));

        $this->jsonRequest('POST', '/api/' . $entityName, $createPayload);
        self::assertResponseStatusCodeSame(201);
        $created = $this->responseData();
        self::assertSame($createPayload['title'], $created['title']);
        self::assertArrayHasKey('id', $created);

        $createdId = $created['id'];

        $this->client->request('GET', sprintf('/api/%s/%d', $entityName, $createdId));
        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('title', $createPayload['title']);

        $this->jsonRequest('PATCH', sprintf('/api/%s/%d', $entityName, $createdId), $updatePayload);
        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('title', $updatePayload['title']);

        $this->jsonRequest('DELETE', sprintf('/api/%s/%d', $entityName, $createdId));
        self::assertResponseStatusCodeSame(204);

        $this->assertGetNotFound(sprintf('/api/%s/%d', $entityName, $createdId));
    }

    private function gamePayload(string $title): array
    {
        return [
            'title' => $title,
            'content' => $title . ' content with enough characters.',
            'summary' => $title . ' summary',
            'status' => 'Published',
            'platformRequirementsLevel' => 'Medium',
            'ageRating' => '16+',
        ];
    }

    private function newsPayload(string $title): array
    {
        return [
            'title' => $title,
            'content' => $title . ' content with enough characters.',
            'summary' => $title . ' summary',
            'status' => 'Published',
            'author' => (string) $this->adminUser->getId(),
            'tag' => [(string) $this->tag->getId()],
            'game' => [(string) $this->game->getId()],
        ];
    }

    private function reviewPayload(string $title): array
    {
        return [
            'title' => $title,
            'content' => $title . ' content with enough characters.',
            'summary' => $title . ' summary',
            'status' => 'Published',
            'author' => (string) $this->adminUser->getId(),
            'gameRating' => 9,
            'tag' => [(string) $this->tag->getId()],
            'game' => [(string) $this->game->getId()],
        ];
    }
}
