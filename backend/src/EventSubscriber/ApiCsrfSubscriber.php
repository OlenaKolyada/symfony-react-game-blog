<?php

namespace App\EventSubscriber;

use App\Security\CsrfTokenManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final readonly class ApiCsrfSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private CsrfTokenManager $csrfTokenManager
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['validateCsrfToken', 16],
        ];
    }

    public function validateCsrfToken(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();
        if (!$this->shouldValidate($request)) {
            return;
        }

        if (!$this->csrfTokenManager->isTokenValid($request)) {
            $event->setResponse(new JsonResponse(
                ['error' => 'Invalid CSRF token'],
                Response::HTTP_FORBIDDEN
            ));
        }
    }

    private function shouldValidate(Request $request): bool
    {
        if (!in_array($request->getMethod(), ['POST', 'PATCH', 'DELETE'], true)) {
            return false;
        }

        if (!str_starts_with($request->getPathInfo(), '/api/')) {
            return false;
        }

        if ($request->getPathInfo() === '/api/login') {
            return false;
        }

        return $request->cookies->has('session_id');
    }
}
