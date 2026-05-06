<?php

namespace App\Tests\Functional;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class LoginRateLimitSecurityTest extends ApiTestCase
{
    public function testInvalidLoginAttemptsAreRateLimitedByEmailAndIp(): void
    {
        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->jsonRequest('POST', '/api/login', [
                'email' => 'limited-missing@example.com',
                'password' => 'wrong-password',
            ]);

            self::assertResponseStatusCodeSame(401);
        }

        $this->jsonRequest('POST', '/api/login', [
            'email' => 'limited-missing@example.com',
            'password' => 'wrong-password',
        ]);

        self::assertResponseStatusCodeSame(429);
        $this->assertJsonFieldEquals('error', 'Too many login attempts');
    }

    public function testCorrectCredentialsAreBlockedAfterLimitForSameEmailAndIp(): void
    {
        $this->createRateLimitedUser('limited-user@example.com', 'limited-password');

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->jsonRequest('POST', '/api/login', [
                'email' => 'limited-user@example.com',
                'password' => 'wrong-password',
            ]);

            self::assertResponseStatusCodeSame(401);
        }

        $this->jsonRequest('POST', '/api/login', [
            'email' => 'limited-user@example.com',
            'password' => 'limited-password',
        ]);

        self::assertResponseStatusCodeSame(429);
        $this->assertJsonFieldEquals('error', 'Too many login attempts');
    }

    public function testRateLimitKeyDoesNotBlockDifferentEmailOnSameIp(): void
    {
        $this->createRateLimitedUser('limited-one@example.com', 'limited-password');
        $this->createRateLimitedUser('limited-two@example.com', 'limited-password');

        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->jsonRequest('POST', '/api/login', [
                'email' => 'limited-one@example.com',
                'password' => 'wrong-password',
            ]);

            self::assertResponseStatusCodeSame(401);
        }

        $this->jsonRequest('POST', '/api/login', [
            'email' => 'limited-two@example.com',
            'password' => 'limited-password',
        ]);

        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('message', 'Login successful');
    }

    private function createRateLimitedUser(string $email, string $plainPassword): User
    {
        $passwordHasher = static::getContainer()->get(UserPasswordHasherInterface::class);

        $user = (new User())
            ->setEmail($email)
            ->setNickname(str_replace('@example.com', '', $email))
            ->setRoles(['ROLE_USER']);
        $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }
}
