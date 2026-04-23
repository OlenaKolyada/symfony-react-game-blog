<?php

namespace App\Controller\Comment;

use App\Controller\Abstract\AbstractDeleteEntityAction;
use App\Entity\Comment;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Nelmio\ApiDocBundle\Attribute\Security;
use OpenApi\Attributes as OA;

class DeleteCommentAction extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $manager,
        private readonly TagAwareCacheInterface $cache
    ) {}

    #[Route('/api/comment/{id}', name: 'app_delete_comment_item', methods: ['DELETE'])]
    #[IsGranted('ROLE_USER', message: 'You do not have sufficient permissions')]
    #[OA\Response(response: 204, description: "Comment item successfully deleted")]
    #[OA\Response(response: 401, description: "Unauthorized - JWT Token not found")]
    #[OA\Response(response: 403, description: "Access denied - insufficient permissions")]
    #[OA\Response(response: 404, description: "Comment not found")]
    #[OA\Parameter(name: "id", description: "Comment ID", in: "path",
        required: true, schema: new OA\Schema(type: "integer")
    )]
    #[OA\Tag(name: "Comment")]
    #[Security(name: "bearerAuth")]
    public function __invoke(Comment $comment): Response
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['error' => 'Not authenticated'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $isAdmin = in_array('ROLE_ADMIN', $user->getRoles(), true);
        $isOwner = $comment->getAuthor()?->getId() === $user->getId();

        if (!$isAdmin && !$isOwner) {
            return new JsonResponse(['error' => 'You can only delete your own comments'], JsonResponse::HTTP_FORBIDDEN);
        }

        $this->cache->invalidateTags(['commentCache', 'reviewCache']);
        $this->manager->remove($comment);
        $this->manager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}
