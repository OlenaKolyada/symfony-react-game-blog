<?php

namespace App\Tests\Functional;

final class CorsSecurityTest extends ApiTestCase
{
    public function testApiCorsPreflightDoesNotAllowArbitraryHeaders(): void
    {
        $this->client->request(
            'OPTIONS',
            '/api/profile',
            [],
            [],
            [
                'HTTP_ORIGIN' => 'http://localhost:3000',
                'HTTP_ACCESS_CONTROL_REQUEST_METHOD' => 'GET',
                'HTTP_ACCESS_CONTROL_REQUEST_HEADERS' => 'X-Exploit, Content-Type',
            ]
        );

        self::assertResponseStatusCodeSame(400);
        self::assertStringContainsString('Unauthorized header x-exploit', $this->client->getResponse()->getContent());
    }

    public function testApiCorsPreflightAllowsExpectedHeaders(): void
    {
        $this->client->request(
            'OPTIONS',
            '/api/profile',
            [],
            [],
            [
                'HTTP_ORIGIN' => 'http://localhost:3000',
                'HTTP_ACCESS_CONTROL_REQUEST_METHOD' => 'GET',
                'HTTP_ACCESS_CONTROL_REQUEST_HEADERS' => 'Content-Type, Authorization, X-CSRF-Token',
            ]
        );

        self::assertResponseStatusCodeSame(200);

        $allowedHeaders = $this->client->getResponse()->headers->get('Access-Control-Allow-Headers');

        self::assertNotNull($allowedHeaders);
        self::assertStringContainsString('content-type', $allowedHeaders);
        self::assertStringContainsString('authorization', $allowedHeaders);
        self::assertStringContainsString('x-csrf-token', $allowedHeaders);
    }
}
