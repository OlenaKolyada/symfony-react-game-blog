<?php

namespace App\Tests\Functional;

final class ResolveSlugSecurityTest extends ApiTestCase
{
    public function testUnknownEntityTypeDoesNotExposeInternalError(): void
    {
        $this->client->request('GET', '/api/unknown-entity/resolve/seed-game');

        self::assertResponseStatusCodeSame(404);
        $this->assertJsonFieldEquals('error', 'Entity not found');
    }
}
