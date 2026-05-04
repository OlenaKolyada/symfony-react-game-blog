<?php

namespace App\Tests\Functional;

use App\Entity\Comment;
use App\Enum\CommentStatusEnum;

final class CommentVisibilitySecurityTest extends ApiTestCase
{
    public function testRegularUserCannotReadDeletedCommentById(): void
    {
        $comment = $this->createComment(CommentStatusEnum::Deleted, 'Deleted comment content');

        $this->loginAsRegularUser();

        $this->assertGetNotFound('/api/comment/' . $comment->getId());
    }

    public function testRegularUserCannotListDeletedComments(): void
    {
        $comment = $this->createComment(CommentStatusEnum::Deleted, 'Deleted comment content');

        $this->loginAsRegularUser();

        $this->client->request('GET', '/api/comment');
        self::assertResponseStatusCodeSame(200);
        $this->assertListDoesNotContainId($comment->getId());

        $this->client->request('GET', '/api/comment?status=Deleted');
        self::assertResponseStatusCodeSame(403);
    }

    public function testAdminCanReadDeletedComments(): void
    {
        $comment = $this->createComment(CommentStatusEnum::Deleted, 'Deleted comment content');

        $this->loginAsAdmin();

        $this->client->request('GET', '/api/comment/' . $comment->getId());
        self::assertResponseStatusCodeSame(200);

        $this->client->request('GET', '/api/comment?status=Deleted');
        self::assertResponseStatusCodeSame(200);
        $this->assertListContainsId($comment->getId());
    }

    private function createComment(CommentStatusEnum $status, string $content): Comment
    {
        $comment = (new Comment())
            ->setContent($content)
            ->setStatus($status)
            ->setAuthor($this->regularUser)
            ->setReview($this->review);

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        return $comment;
    }

    private function assertListContainsId(int $id): void
    {
        self::assertContains($id, $this->responseIds());
    }

    private function assertListDoesNotContainId(int $id): void
    {
        self::assertNotContains($id, $this->responseIds());
    }

    private function responseIds(): array
    {
        return array_map(
            static fn (array $item): int => $item['id'],
            $this->responseData()
        );
    }
}
