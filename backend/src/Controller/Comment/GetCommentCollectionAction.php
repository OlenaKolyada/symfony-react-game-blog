<?php

namespace App\Controller\Comment;

use App\Controller\Abstract\AbstractGetMetaEntityCollectionAction;
use App\Entity\Comment;
use App\Enum\CommentStatusEnum;
use App\Repository\CommentRepository;
use App\Service\CacheService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;

class GetCommentCollectionAction extends AbstractGetMetaEntityCollectionAction
{
    public function __construct(
        CommentRepository $repository,
        CacheService $cacheService,
        private readonly Security $security
    ) {
        parent::__construct($repository, $cacheService);
    }

    #[Route('/api/comment', name: 'api_get_comment_collection', methods: ['GET'])]
    #[OA\Response(response: 200,
        description: "Get a Comment collection",
        content: new OA\JsonContent(
            type: "array",
            items: new OA\Items(
                ref: new Model(
                    type: Comment::class,
                    groups: ["getCommentCollection"]
                ))))]
    #[OA\Parameter(name: "status",
        description: "Comment status",
        in: "query",
        schema: new OA\Schema(
            type: "string",
            enum: ["Published", "Edited", "Deleted"]
        ))]
    #[OA\Tag(name: "Comment")]
    public function __invoke(Request $request): JsonResponse
    {
        $status = $request->query->get('status');
        $reviewId = $request->query->get('review');
        $criteria = [];
        $criteriaIdParts = [];

        if (!$this->security->isGranted('ROLE_ADMIN')) {
            if ($status === CommentStatusEnum::Deleted->value) {
                return new JsonResponse(['error' => 'Access denied'], Response::HTTP_FORBIDDEN);
            }

            if (!$status) {
                $criteria['status'] = [CommentStatusEnum::Published, CommentStatusEnum::Edited];
                $criteriaIdParts[] = 'visible';
            }
        }

        if ($status) {
            $criteria['status'] = $status;
            $criteriaIdParts[] = $status;
        }
        if ($reviewId) {
            $criteria['review'] = $reviewId;
            $criteriaIdParts[] = $reviewId;
        }

        return $this->getEntityData(
            'Comment',
            'comment',
            'getCommentCollection',
            ['comment'],
            $criteria,
            implode('-', $criteriaIdParts)
        );
    }
}
