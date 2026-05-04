<?php

namespace App\Tests\Functional;

final class UserReadAccessSecurityTest extends ApiTestCase
{
    public function testAnonymousUserCannotReadUsers(): void
    {
        $this->client->request('GET', '/api/user');
        self::assertResponseStatusCodeSame(401);

        $this->client->request('GET', '/api/user/' . $this->regularUser->getId());
        self::assertResponseStatusCodeSame(401);
    }

    public function testAdminCanReadUsers(): void
    {
        $this->loginAsAdmin();

        $this->client->request('GET', '/api/user');
        self::assertResponseStatusCodeSame(200);

        $this->client->request('GET', '/api/user/' . $this->regularUser->getId());
        self::assertResponseStatusCodeSame(200);
    }

    public function testRegularUserCannotReadUsers(): void
    {
        $this->loginAsRegularUser();

        $this->assertGetForbidden('/api/user');
        $this->assertGetForbidden('/api/user/' . $this->adminUser->getId());
    }
}
