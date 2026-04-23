<?php

namespace App\Controller\Comment;

use App\Controller\Abstract\AbstractCreateEntityAction;
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

class CreateCommentAction extends AbstractController
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
        $this->fieldConfig = $configFactory->create('comment');
    }

    #[Route('/api/comment',
        name: 'app_create_comment_item',
        requirements: ['_format' => 'json'],
        methods: ['POST'])]
    #[IsGranted('ROLE_USER', message: 'You do not have sufficient permissions')]
    #[OA\Response(response: 201, description: "Comment successfully created")]
    #[OA\Response(response: 400, description: "Validation failed - invalid data provided")]
    #[OA\Response(response: 401, description: "Unauthorized - JWT Token not found")]
    #[OA\Response(response: 403, description: "Access denied - insufficient permissions")]
    #[OA\RequestBody(
        description: "Comment data",
        required: true,
        content: new OA\MediaType(
            mediaType: "application/json",
            schema: new OA\Schema(
                required: ["content", "status", "review"],
                properties: [
                    new OA\Property(property: "content", type: "string", example: "New comment"),
                    new OA\Property(property: "review", type: "string", example: '1')
                ])))]
    #[OA\Tag(name: "Comment")]
    #[Security(name: "bearerAuth")]
    public function __invoke(
        Request $request
    ): JsonResponse
    {
        /** @var User|null $user */
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['error' => 'Not authenticated'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $content = $request->toArray();
        unset($content['author'], $content['status']);

        $comment = new Comment();
        $comment->setAuthor($user);
        $comment->setStatus(CommentStatusEnum::Published);

        $validationErrors = new \Symfony\Component\Validator\ConstraintViolationList();
        $this->fieldProcessor->processFieldsFromConfig($comment, $content, $this->fieldConfig, $validationErrors);

        $errorResponse = $this->errorProcessor->processErrors($comment, $validationErrors);
        if ($errorResponse) {
            return $errorResponse;
        }

        $this->manager->persist($comment);
        $this->manager->flush();
        $this->cache->invalidateTags(['commentCache', 'reviewCache']);

        return $this->responseProcessor->createSuccessResponse($comment, 'getComment', 201);
    }
}
