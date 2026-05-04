<?php

namespace App\Tests\Functional;

final class PaginationSecurityTest extends ApiTestCase
{
    public function testCoreListPaginationLimitIsClamped(): void
    {
        $this->client->request('GET', '/api/game?page=0&limit=9999');

        self::assertResponseStatusCodeSame(200);

        $pagination = $this->responseData()['pagination'];

        self::assertSame(1, $pagination['page']);
        self::assertSame(50, $pagination['limit']);
    }
}
