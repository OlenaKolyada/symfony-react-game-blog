<?php

namespace App\Tests\Functional;

final class StatsAccessSecurityTest extends ApiTestCase
{
    public function testAnonymousCannotAccessStats(): void
    {
        $this->client->request('GET', '/stats');

        self::assertResponseRedirects('/admin/login');
    }

    public function testAdminCanAccessStats(): void
    {
        $this->client->loginUser($this->adminUser, 'admin');

        $this->client->request('GET', '/stats');

        self::assertResponseStatusCodeSame(200);
    }
}
