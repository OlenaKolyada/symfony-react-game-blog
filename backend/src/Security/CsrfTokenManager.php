<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;

final class CsrfTokenManager
{
    public const string COOKIE_NAME = 'csrf_token';
    public const string HEADER_NAME = 'X-CSRF-Token';

    public function createToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    public function isTokenValid(Request $request): bool
    {
        $cookieToken = $request->cookies->get(self::COOKIE_NAME);
        $headerToken = $request->headers->get(self::HEADER_NAME);

        if (!$cookieToken || !$headerToken) {
            return false;
        }

        return hash_equals($cookieToken, $headerToken);
    }

    public function createCookie(string $token, int $expiresAt): Cookie
    {
        return new Cookie(
            self::COOKIE_NAME,
            $token,
            $expiresAt,
            '/',
            null,
            false,
            false,
            false,
            Cookie::SAMESITE_LAX
        );
    }

    public function clearCookie(): Cookie
    {
        return new Cookie(
            self::COOKIE_NAME,
            '',
            time() - 3600,
            '/',
            null,
            false,
            false,
            false,
            Cookie::SAMESITE_LAX
        );
    }
}
