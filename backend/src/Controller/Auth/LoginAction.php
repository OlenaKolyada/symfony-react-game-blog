<?php

namespace App\Controller\Auth;

use App\Entity\User;
use App\Security\CsrfTokenManager;
use App\Service\TokenManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class LoginAction extends AbstractController
{
    public function __construct(
        private readonly TokenManager $tokenManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly EntityManagerInterface $entityManager,
        private readonly CsrfTokenManager $csrfTokenManager,
        private readonly bool $sessionCookieSecure,
        private readonly RateLimiterFactory $loginLimiter
    ) {}

    #[OA\Post(
        path: "/api/login",
        description: "Send credentials to log in and receive a session cookie",
        summary: "Login to get authentication cookie",
        tags: ["Auth"]
    )]
    #[OA\RequestBody(
        description: "User credentials",
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "email", type: "string", example: "brie@gmail.com"),
                new OA\Property(property: "password", type: "string", example: "password")
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: "Login successful (sets session_id cookie)",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "message", type: "string", example: "Login successful")
            ]
        )
    )]
    #[OA\Response(
        response: 400,
        description: "Missing credentials",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "error", type: "string", example: "Missing credentials")
            ]
        )
    )]
    #[OA\Response(
        response: 401,
        description: "Invalid credentials",
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "error", type: "string", example: "Invalid credentials")
            ]
        )
    )]
    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        // Валидация данных
        if (!isset($data['email']) || !isset($data['password'])) {
            return new JsonResponse(['error' => 'Missing credentials'], Response::HTTP_BAD_REQUEST);
        }

        $limiter = $this->loginLimiter->create($this->createRateLimitKey($data['email'], $request));
        $limit = $limiter->consume();

        if (!$limit->isAccepted()) {
            return new JsonResponse(['error' => 'Too many login attempts'], Response::HTTP_TOO_MANY_REQUESTS);
        }

        $user = $this->entityManager->getRepository(User::class)
            ->findOneBy(['email' => $data['email']]);

        // Проверка пароля
        if (!$user || !$this->passwordHasher->isPasswordValid($user, $data['password'])) {
            return new JsonResponse(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        }

        $limiter->reset();

        // Создание токена
        $tokenCreationResult = $this->tokenManager->createToken($user);
        $userToken = $tokenCreationResult->getUserToken();

        // Создание ответа с сессионным id в HttpOnly cookie
        $response = new JsonResponse([
            'message' => 'Login successful',
        ]);

        $response->headers->setCookie(new Cookie(
            'session_id',          // Имя куки
            $tokenCreationResult->getRawSessionId(), // Значение (sessionId, не сам JWT)
            $userToken->getExpiresAt()->getTimestamp(), // Время истечения
            '/',                   // Путь
            null,                  // Домен
            $this->sessionCookieSecure, // HTTPS only when enabled by environment
            true,                  // HttpOnly
            false,                 // Raw
            Cookie::SAMESITE_LAX   // LAX для работы между портами
        ));
        $response->headers->setCookie(
            $this->csrfTokenManager->createCookie(
                $this->csrfTokenManager->createToken(),
                $userToken->getExpiresAt()->getTimestamp()
            )
        );

        return $response;
    }

    private function createRateLimitKey(string $email, Request $request): string
    {
        $normalizedEmail = strtolower(trim($email));
        $clientIp = $request->getClientIp() ?? 'unknown';

        return hash('sha256', $normalizedEmail . '|' . $clientIp);
    }
}
