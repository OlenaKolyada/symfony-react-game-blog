<?php

namespace App\Controller\Auth;

use App\Security\CsrfTokenManager;
use App\Service\TokenManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Attributes as OA;

class LogoutAction extends AbstractController
{
    public function __construct(
        private readonly TokenManager $tokenManager,
        private readonly CsrfTokenManager $csrfTokenManager,
        private readonly bool $sessionCookieSecure
    ) {}

    #[OA\Tag(name: "Auth")]
    #[Route('/api/logout', name: 'api_logout', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        // Получаем sessionId из куки
        $sessionId = $request->cookies->get('session_id');

        if ($sessionId) {
            // Отзываем токен
            $this->tokenManager->revokeToken($sessionId);
        }

        // Создаем ответ и удаляем куки
        $response = new JsonResponse(['message' => 'Logout successful']);
        $response->headers->setCookie(new Cookie(
            'session_id',        // То же имя куки
            '',                 // Пустое значение
            time() - 3600,      // Время в прошлом
            '/',                // Тот же путь
            null,               // Тот же домен
            $this->sessionCookieSecure, // Same as login cookie
            true,               // HttpOnly
            false,              // Raw
            Cookie::SAMESITE_LAX // Same as login cookie
        ));
        $response->headers->setCookie($this->csrfTokenManager->clearCookie());

        return $response;
    }
}
