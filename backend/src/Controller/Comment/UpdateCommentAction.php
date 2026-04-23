<?php

namespace App\Controller\Comment;

use App\Controller\Abstract\AbstractUpdateEntityAction;
use App\Entity\Comment;
use App\Entity\User;
use App\Enum\CommentStatusEnum;
use App\Service\EntityField\Configuration\EntityConfigurationFactoryInterface;
use App\Service\EntityField\Processor\ErrorProcessor;
use App\Service\EntityField\Processor\FieldProcessor;
use App\Service\EntityField\Processor\ResponseProcessor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Nelmio\ApiDocBundle\Attribute\Security;
use OpenApi\Attributes as OA;

class UpdateCommentAction extends AbstractController
{
    private array $fieldConfig;

    public function __construct(
        private readonly EntityManagerInterface $manager,
        private readonly FieldProcessor $fieldProcessor,
        private readonly ErrorProcessor $errorProcessor,
        private readonly ResponseProcessor $responseProcessor,
        EntityConfigurationFactoryInterface $configFactory,
        private readonly TagAwareCacheInterface $cache
    ) {
        $this->fieldConfig = $configFactory->createForUpdate('comment');
    }

    #[Route('/api/comment/{id}',
        name: 'app_update_comment_item',
        requirements: ['_format' => 'json'],
        methods: ['PATCH'])]
    #[IsGranted('ROLE_USER', message: 'You do not have sufficient permissions')]
    #[OA\Parameter(name: "id",
        description: "Comment ID",
        in: "path",
        required: true,
        schema: new OA\Schema(type: "integer"))]
    #[OA\Response(response: 200, description: "Comment item successfully updated")]
    #[OA\Response(response: 400, description: "Validation failed - invalid data provided")]
    #[OA\Response(response: 401, description: "Unauthorized - JWT Token not found")]
    #[OA\Response(response: 403, description: "Access denied - insufficient permissions")]
    #[OA\Response(response: 404, description: "Comment not found")]
    #[OA\RequestBody(
        description: "Comment data",
        required: true,
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                properties: [
                    new OA\Property(property: "content", type: "string", example: "Edited comment"),
                    new OA\Property(property: "status", type: "string",
                        enum: ["Published", "Edited", "Deleted"],
                        example: 'Deleted'),
                    new OA\Property(property: "author", type: "string", example: '2'),
                    new OA\Property(property: "review", type: "string", example: '2')
                ])))]
    #[OA\Tag(name: "Comment")]
    #[Security(name: "bearerAuth")]
    public function __invoke(Request $request, Comment $comment): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['error' => 'Not authenticated'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $isAdmin = in_array('ROLE_ADMIN', $user->getRoles(), true);
        $isOwner = $comment->getAuthor()?->getId() === $user->getId();

        if (!$isAdmin && !$isOwner) {
            return new JsonResponse(['error' => 'You can only edit your own comments'], JsonResponse::HTTP_FORBIDDEN);
        }

        $content = $request->toArray();
        unset($content['author'], $content['review']);
        $content['review'] = (string) $comment->getReview()?->getId();

        if (array_key_exists('content', $content)) {
            $comment->setStatus(CommentStatusEnum::Edited);
        }

        if (!$isAdmin) {
            unset($content['status']);
        }

        $validationErrors = new \Symfony\Component\Validator\ConstraintViolationList();
        $this->fieldProcessor->processFieldsFromConfig($comment, $content, $this->fieldConfig, $validationErrors);

        $errorResponse = $this->errorProcessor->processErrors($comment, $validationErrors);
        if ($errorResponse) {
            return $errorResponse;
        }

        $this->manager->flush();
        $this->cache->invalidateTags(['commentCache', 'reviewCache']);

        return $this->responseProcessor->createSuccessResponse($comment, 'getComment');
    }
}
