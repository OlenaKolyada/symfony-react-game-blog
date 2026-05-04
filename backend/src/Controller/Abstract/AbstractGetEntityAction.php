<?php

namespace App\Controller\Abstract;

use App\Enum\StatusEnum;
use App\Service\CacheService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\SecurityBundle\Security;

abstract class AbstractGetEntityAction
{
    public function __construct(
        protected readonly CacheService $cacheService,
        protected readonly ?Security $accessSecurity = null
    ) {
    }
    protected function getEntityData(
        object $entity,
        string $entityType,
        string $cachePrefix,
        string $serializationGroup,
        array $cacheGroups
    ): JsonResponse
    {
        if (!$this->canReadEntity($entity)) {
            throw new NotFoundHttpException();
        }

        $idCache = "get{$entityType}Action-" . $entity->getId();

        $jsonData = $this->cacheService->getCachedData(
            $idCache,
            "{$cachePrefix}Cache",
            function () use ($entity) {
                return $entity;
            },
            $serializationGroup,
            $cacheGroups
        );

        return new JsonResponse(
            $jsonData,
            Response::HTTP_OK,
            [],
            true
        );
    }

    private function canReadEntity(object $entity): bool
    {
        if (!method_exists($entity, 'getStatus')) {
            return true;
        }

        $status = $entity->getStatus();
        if (!$status instanceof StatusEnum) {
            return true;
        }

        if ($status === StatusEnum::Published) {
            return true;
        }

        return $this->accessSecurity?->isGranted('ROLE_ADMIN') ?? false;
    }
}
