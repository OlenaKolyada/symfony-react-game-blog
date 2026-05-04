<?php

namespace App\Tests\Functional;

final class CoreContentVisibilitySecurityTest extends ApiTestCase
{
    public function testPublicCoreEndpointsDoNotExposeNonPublishedContent(): void
    {
        $this->loginAsAdmin();

        $items = [];
        foreach (['Draft', 'Archived', 'Deleted'] as $status) {
            $items[$status] = [
                'game' => $this->createCoreEntity('game', $this->gamePayload($status . ' Visibility Game', strtolower($status) . '-visibility-game', $status)),
                'news' => $this->createCoreEntity('news', $this->newsPayload($status . ' Visibility News', strtolower($status) . '-visibility-news', $status)),
                'review' => $this->createCoreEntity('review', $this->reviewPayload($status . ' Visibility Review', strtolower($status) . '-visibility-review', $status)),
            ];
        }

        foreach ($items as $status => $entities) {
            foreach ($entities as $entityName => $item) {
                $this->client->request('GET', sprintf('/api/%s/%d', $entityName, $item['id']));
                self::assertResponseStatusCodeSame(200);

                $this->client->request('GET', sprintf('/api/%s?status=%s', $entityName, $status));
                self::assertResponseStatusCodeSame(200);

                $this->client->request('GET', sprintf('/api/%s/resolve/%s', $entityName, $item['slug']));
                self::assertResponseStatusCodeSame(200);
            }
        }

        $this->client->restart();

        foreach ($items as $status => $entities) {
            foreach ($entities as $entityName => $item) {
                $this->client->request('GET', '/api/' . $entityName);
                self::assertResponseStatusCodeSame(200);
                $this->assertListDoesNotContainId($item['id']);

                $this->client->request('GET', sprintf('/api/%s?status=%s', $entityName, $status));
                self::assertResponseStatusCodeSame(403);

                $this->assertGetNotFound(sprintf('/api/%s/%d', $entityName, $item['id']));

                $this->client->request('GET', sprintf('/api/%s/resolve/%s', $entityName, $item['slug']));
                self::assertResponseStatusCodeSame(404);
            }
        }
    }

    private function createCoreEntity(string $entityName, array $payload): array
    {
        $this->jsonRequest('POST', '/api/' . $entityName, $payload);
        self::assertResponseStatusCodeSame(201);

        $created = $this->responseData();

        return [
            'id' => $created['id'],
            'slug' => $payload['slug'],
        ];
    }

    private function assertListDoesNotContainId(int $id): void
    {
        $ids = array_map(
            static fn (array $item): int => $item['id'],
            $this->responseData()['items']
        );

        self::assertNotContains($id, $ids);
    }

    private function gamePayload(string $title, string $slug, string $status): array
    {
        return [
            'title' => $title,
            'slug' => $slug,
            'content' => $title . ' content with enough characters.',
            'summary' => $title . ' summary',
            'status' => $status,
            'platformRequirementsLevel' => 'Medium',
            'ageRating' => '16+',
        ];
    }

    private function newsPayload(string $title, string $slug, string $status): array
    {
        return [
            'title' => $title,
            'slug' => $slug,
            'content' => $title . ' content with enough characters.',
            'summary' => $title . ' summary',
            'status' => $status,
            'author' => (string) $this->adminUser->getId(),
            'tag' => [(string) $this->tag->getId()],
            'game' => [(string) $this->game->getId()],
        ];
    }

    private function reviewPayload(string $title, string $slug, string $status): array
    {
        return [
            'title' => $title,
            'slug' => $slug,
            'content' => $title . ' content with enough characters.',
            'summary' => $title . ' summary',
            'status' => $status,
            'author' => (string) $this->adminUser->getId(),
            'gameRating' => 9,
            'tag' => [(string) $this->tag->getId()],
            'game' => [(string) $this->game->getId()],
        ];
    }
}
