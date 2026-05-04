<?php

namespace App\Tests\Functional;

use App\Security\CsrfTokenManager;

final class CsrfSecurityTest extends ApiTestCase
{
    public function testLoginSetsCsrfTokenCookie(): void
    {
        $this->loginAsAdmin();

        $cookie = $this->client->getCookieJar()->get('csrf_token');

        self::assertNotNull($cookie);
        self::assertNotSame('', $cookie->getValue());
        self::assertFalse($cookie->isSecure());
        self::assertFalse($cookie->isHttpOnly());
        self::assertSame('lax', strtolower($cookie->getSameSite()));
    }

    public function testCsrfCookieUsesSecureFlagWhenEnabled(): void
    {
        $manager = new CsrfTokenManager(true);

        self::assertTrue($manager->createCookie('csrf-token', time() + 3600)->isSecure());
        self::assertTrue($manager->clearCookie()->isSecure());
    }

    public function testMutatingRequestWithoutCsrfHeaderIsRejected(): void
    {
        $this->loginAsAdmin();

        $this->client->request(
            'PATCH',
            '/api/tag/' . $this->tag->getId(),
            [],
            [],
            ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'],
            json_encode(['title' => 'Blocked Tag'], JSON_THROW_ON_ERROR)
        );

        self::assertResponseStatusCodeSame(403);
        $this->assertJsonFieldEquals('error', 'Invalid CSRF token');
    }

    public function testMutatingRequestWithWrongCsrfHeaderIsRejected(): void
    {
        $this->loginAsAdmin();

        $this->client->request(
            'PATCH',
            '/api/tag/' . $this->tag->getId(),
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_ACCEPT' => 'application/json',
                'HTTP_X_CSRF_TOKEN' => 'wrong-token',
            ],
            json_encode(['title' => 'Blocked Tag'], JSON_THROW_ON_ERROR)
        );

        self::assertResponseStatusCodeSame(403);
        $this->assertJsonFieldEquals('error', 'Invalid CSRF token');
    }

    public function testMutatingRequestWithMatchingCsrfTokenIsAllowed(): void
    {
        $this->loginAsAdmin();

        $this->jsonRequest('PATCH', '/api/tag/' . $this->tag->getId(), ['title' => 'Allowed Tag']);

        self::assertResponseStatusCodeSame(200);
        $this->assertJsonFieldEquals('title', 'Allowed Tag');
    }

    public function testLogoutRequiresCsrfTokenAndClearsCsrfCookie(): void
    {
        $this->loginAsAdmin();

        $this->client->request('POST', '/api/logout');
        self::assertResponseStatusCodeSame(403);

        $this->jsonRequest('POST', '/api/logout');
        self::assertResponseStatusCodeSame(200);

        $csrfClearCookie = null;
        foreach ($this->client->getResponse()->headers->getCookies() as $cookie) {
            if ($cookie->getName() === 'csrf_token') {
                $csrfClearCookie = $cookie;
                break;
            }
        }

        self::assertNotNull($csrfClearCookie);
        self::assertLessThan(time(), $csrfClearCookie->getExpiresTime());
    }
}
