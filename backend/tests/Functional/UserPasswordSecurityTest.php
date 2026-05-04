<?php

namespace App\Tests\Functional;

use App\Entity\User;

final class UserPasswordSecurityTest extends ApiTestCase
{
    public function testAdminCreateUserHashesPassword(): void
    {
        $this->loginAsAdmin();

        $this->jsonRequest('POST', '/api/user', [
            'nickname' => 'Created User',
            'email' => 'created-user@example.com',
            'password' => 'plain-create-password',
            'roles' => ['ROLE_USER'],
        ]);

        self::assertResponseStatusCodeSame(201);
        $created = $this->responseData();

        $this->entityManager->clear();
        $user = $this->entityManager->getRepository(User::class)->find($created['id']);

        self::assertInstanceOf(User::class, $user);
        self::assertNotSame('plain-create-password', $user->getPassword());
        self::assertStringStartsWith('$', $user->getPassword());
    }

    public function testAdminUpdateUserHashesPassword(): void
    {
        $userId = $this->regularUser->getId();

        $this->loginAsAdmin();

        $this->jsonRequest('PATCH', '/api/user/' . $userId, [
            'password' => 'plain-update-password',
        ]);

        self::assertResponseStatusCodeSame(200);

        $this->entityManager->clear();
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        self::assertInstanceOf(User::class, $user);
        self::assertNotSame('plain-update-password', $user->getPassword());
        self::assertStringStartsWith('$', $user->getPassword());
    }

    public function testAdminUpdateUserWithoutPasswordKeepsExistingPasswordHash(): void
    {
        $userId = $this->regularUser->getId();
        $existingPasswordHash = $this->regularUser->getPassword();

        $this->loginAsAdmin();

        $this->jsonRequest('PATCH', '/api/user/' . $userId, [
            'nickname' => 'Updated User',
        ]);

        self::assertResponseStatusCodeSame(200);

        $this->entityManager->clear();
        $user = $this->entityManager->getRepository(User::class)->find($userId);

        self::assertInstanceOf(User::class, $user);
        self::assertSame($existingPasswordHash, $user->getPassword());
    }
}
