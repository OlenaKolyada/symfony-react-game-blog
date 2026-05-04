<?php

namespace App\Controller\Abstract;

use App\Enum\StatusEnum;
use App\Service\CacheService;
use App\Trait\PaginationTrait;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractGetCoreEntityCollectionAction
{
    use PaginationTrait;

    public function __construct(
        protected readonly mixed $repository,
        protected readonly CacheService $cacheService,
        protected readonly Security $security
    ) {
    }
    protected function getEntityData(
        Request $request,
        string $entityType,
        string $cachePrefix,
        string $serializationGroup,
        array $cacheGroups
    ): JsonResponse {
        $pagination = $this->preparePaginationCriteria($request);
        $status = $pagination['criteria']['status'] ?? 'Published';

        if ($status !== StatusEnum::Published->value && !$this->security->isGranted('ROLE_ADMIN')) {
            return new JsonResponse(['error' => 'Access denied'], Response::HTTP_FORBIDDEN);
        }

        $sortParam = $request->query->get('sort', 'createdAt:desc');
        [$sortField, $sortDirection] = array_pad(explode(':', $sortParam, 2), 2, 'desc');

        $sortDirection = strtolower($sortDirection) === 'asc' ? 'ASC' : 'DESC';

        $allowedSortFields = ['updatedAt', 'createdAt'];
        if (!in_array($sortField, $allowedSortFields, true)) {
            return new JsonResponse(['error' => 'Invalid sort field'], Response::HTTP_BAD_REQUEST);
        }

        $idCache = "get{$entityType}CollectionAction-" .
            $pagination['page'] . "-" .
            $pagination['limit'] . "-" .
            $status . "-" .
            $sortField . "-" .
            strtolower($sortDirection);

        $jsonData = $this->cacheService->getCachedData(
            $idCache,
            "{$cachePrefix}Cache",
            function() use ($pagination, $status, $sortField, $sortDirection) {
                return $this->repository->findByStatusWithSorting(
                    $status,
                    $pagination['page'],
                    $pagination['limit'],
                    $sortField,
                    $sortDirection
                );
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
}
