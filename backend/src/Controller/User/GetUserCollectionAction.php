<?php

namespace App\Controller\User;

use App\Controller\Abstract\AbstractGetMetaEntityCollectionAction;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\CacheService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class GetUserCollectionAction extends AbstractGetMetaEntityCollectionAction
{
    public function __construct(
        UserRepository $repository,
        CacheService $cacheService
    ) {
        parent::__construct($repository, $cacheService);
    }

    #[Route('/api/user', name: 'app_get_user_collection', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN', message: 'You do not have sufficient permissions')]
    #[OA\Response(response: 200,
        description: "Get a User collection",
        content: new OA\JsonContent(
            type: "array",
            items: new OA\Items(
                ref: new Model(
                    type: User::class,
                    groups: ["getUserCollection"]
                ))))]
    #[OA\Tag(name: "User")]
    public function __invoke(): JsonResponse
    {
        return $this->getEntityData(
            entityType: 'User',
            cachePrefix: 'user',
            serializationGroup: 'getUserCollection',
            cacheGroups: ['user']
        );
    }
}
