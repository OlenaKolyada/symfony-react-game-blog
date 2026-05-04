<?php

namespace App\Tests\Functional;

final class AuthApiTest extends ApiTestCase
{
    public function testLoginSuccessAndAuthorizedProfile(): void
    {
        $this->jsonRequest('POST', '/api/login', [
            'email' => 'admin@example.com',
            'password' => 'admin-password',
        ]);

        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('message', 'Login successful');

        $this->client->request('GET', '/api/profile');

        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('email', 'admin@example.com');
    }

    public function testLoginInvalidCredentials(): void
    {
        $this->jsonRequest('POST', '/api/login', [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ]);

        self::assertResponseStatusCodeSame(401);
        $this->assertJsonFieldEquals('error', 'Invalid credentials');
    }

    public function testProfileUnauthorized(): void
    {
        $this->client->request('GET', '/api/profile');

        self::assertResponseStatusCodeSame(401);
    }

    public function testProfileWithInvalidSessionReturnsGenericAuthenticationError(): void
    {
        $this->client->getCookieJar()->set(new \Symfony\Component\BrowserKit\Cookie('session_id', 'not-a-valid-session-id'));
        $this->client->request('GET', '/api/profile');

        self::assertResponseStatusCodeSame(401);
        $this->assertJsonFieldEquals('error', 'Authentication failed');
    }

    public function testLogoutRevokesCurrentSession(): void
    {
        $this->loginAsAdmin();

        $this->client->request('POST', '/api/logout');
        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('message', 'Logout successful');

        $this->client->request('GET', '/api/profile');
        self::assertResponseStatusCodeSame(401);
    }

    public function testLogoutClearsSessionCookieWithMatchingAttributes(): void
    {
        $this->loginAsAdmin();

        $this->client->request('POST', '/api/logout');

        self::assertResponseStatusCodeSame(200);

        $cookie = $this->client->getResponse()->headers->getCookies()[0] ?? null;

        self::assertNotNull($cookie);
        self::assertSame('session_id', $cookie->getName());
        self::assertFalse($cookie->isSecure());
        self::assertTrue($cookie->isHttpOnly());
        self::assertSame('lax', strtolower($cookie->getSameSite()));
        self::assertLessThan(time(), $cookie->getExpiresTime());
    }
}
