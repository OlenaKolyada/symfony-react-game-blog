<?php

namespace App\Tests\Functional;

use App\Entity\Developer;
use App\Entity\Game;
use App\Entity\Genre;
use App\Entity\News;
use App\Entity\Platform;
use App\Entity\Publisher;
use App\Entity\Review;
use App\Entity\Tag;
use App\Entity\User;
use App\Enum\AgeRatingEnum;
use App\Enum\PlatformRequirementsLevelEnum;
use App\Enum\StatusEnum;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

abstract class ApiTestCase extends WebTestCase
{
    protected KernelBrowser $client;
    protected EntityManagerInterface $entityManager;
    protected User $adminUser;
    protected User $regularUser;
    protected Tag $tag;
    protected Game $game;
    protected News $news;
    protected Review $review;

    protected function setUp(): void
    {
        parent::setUp();

        self::ensureKernelShutdown();
        $this->client = static::createClient();
        $this->entityManager = static::getContainer()->get(EntityManagerInterface::class);

        $this->assertUsingTestDatabase();
        $this->seedBaseData();
    }

    protected function tearDown(): void
    {
        if (isset($this->entityManager) && $this->entityManager->isOpen()) {
            $this->entityManager->clear();
        }

        parent::tearDown();
    }

    protected function loginAsAdmin(): void
    {
        $this->jsonRequest('POST', '/api/login', [
            'email' => 'admin@example.com',
            'password' => 'admin-password',
        ]);

        self::assertResponseStatusCodeSame(200);
    }

    protected function loginAsRegularUser(): void
    {
        $this->jsonRequest('POST', '/api/login', [
            'email' => 'user@example.com',
            'password' => 'user-password',
        ]);

        self::assertResponseStatusCodeSame(200);
    }

    protected function jsonRequest(string $method, string $uri, array $payload = []): void
    {
        $server = ['CONTENT_TYPE' => 'application/json', 'HTTP_ACCEPT' => 'application/json'];
        $csrfToken = $this->client->getCookieJar()->get('csrf_token')?->getValue();

        if (
            $csrfToken
            && $uri !== '/api/login'
            && in_array($method, ['POST', 'PATCH', 'DELETE'], true)
        ) {
            $server['HTTP_X_CSRF_TOKEN'] = $csrfToken;
        }

        $this->client->request(
            $method,
            $uri,
            [],
            [],
            $server,
            json_encode($payload, JSON_THROW_ON_ERROR)
        );
    }

    protected function responseData(): array
    {
        $content = $this->client->getResponse()->getContent();

        if ($content === false || $content === '') {
            return [];
        }

        return json_decode($content, true, 512, JSON_THROW_ON_ERROR);
    }

    protected function assertJsonFieldEquals(string $field, mixed $expected): void
    {
        $data = $this->responseData();
        self::assertArrayHasKey($field, $data);
        self::assertSame($expected, $data[$field]);
    }

    protected function assertGetNotFound(string $uri): void
    {
        $this->client->catchExceptions(false);

        try {
            $this->client->request('GET', $uri);
            self::assertResponseStatusCodeSame(404);
        } catch (NotFoundHttpException $exception) {
            self::assertSame(404, $exception->getStatusCode());
        } finally {
            $this->client->catchExceptions(true);
        }
    }

    protected function assertGetForbidden(string $uri): void
    {
        $this->client->catchExceptions(false);

        try {
            $this->client->request('GET', $uri);
            self::assertResponseStatusCodeSame(403);
        } catch (AccessDeniedHttpException|AccessDeniedException $exception) {
            self::assertNotEmpty($exception->getMessage());
        } finally {
            $this->client->catchExceptions(true);
        }
    }

    private function assertUsingTestDatabase(): void
    {
        $connection = $this->entityManager->getConnection();
        $params = $connection->getParams();
        $databaseName = $params['dbname'] ?? null;

        if ($databaseName !== 'grem_test') {
            self::fail(sprintf('Refusing to use non-test database "%s".', (string) $databaseName));
        }
    }

    private function seedBaseData(): void
    {
        $passwordHasher = static::getContainer()->get(UserPasswordHasherInterface::class);

        $this->adminUser = $this->createUser('admin@example.com', 'Admin', ['ROLE_ADMIN', 'ROLE_USER'], 'admin-password', $passwordHasher);
        $this->regularUser = $this->createUser('user@example.com', 'User', ['ROLE_USER'], 'user-password', $passwordHasher);

        $developer = (new Developer())
            ->setTitle('Seed Developer')
            ->setSlug('seed-developer')
            ->setCountry('France')
            ->setWebsite('https://developer.example.com');
        $genre = (new Genre())
            ->setTitle('Seed Genre')
            ->setSlug('seed-genre');
        $platform = (new Platform())
            ->setTitle('Seed Platform')
            ->setSlug('seed-platform');
        $publisher = (new Publisher())
            ->setTitle('Seed Publisher')
            ->setSlug('seed-publisher')
            ->setCountry('France')
            ->setWebsite('https://publisher.example.com');
        $this->tag = (new Tag())
            ->setTitle('Seed Tag')
            ->setSlug('seed-tag');

        $this->game = (new Game())
            ->setTitle('Seed Game')
            ->setSlug('seed-game')
            ->setContent('Seed game content with enough characters.')
            ->setSummary('Seed game summary')
            ->setStatus(StatusEnum::Published)
            ->setPlatformRequirementsLevel(PlatformRequirementsLevelEnum::Medium)
            ->setAgeRating(AgeRatingEnum::PEGI_16)
            ->addDeveloper($developer)
            ->addGenre($genre)
            ->addPlatform($platform)
            ->addPublisher($publisher);

        $this->news = (new News())
            ->setTitle('Seed News')
            ->setSlug('seed-news')
            ->setContent('Seed news content with enough characters.')
            ->setSummary('Seed news summary')
            ->setStatus(StatusEnum::Published)
            ->setAuthor($this->adminUser)
            ->addTag($this->tag)
            ->addGame($this->game);

        $this->review = (new Review())
            ->setTitle('Seed Review')
            ->setSlug('seed-review')
            ->setContent('Seed review content with enough characters.')
            ->setSummary('Seed review summary')
            ->setStatus(StatusEnum::Published)
            ->setAuthor($this->adminUser)
            ->setGameRating(8)
            ->addTag($this->tag)
            ->addGame($this->game);

        foreach ([$developer, $genre, $platform, $publisher, $this->tag, $this->game, $this->news, $this->review] as $entity) {
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
    }

    private function createUser(
        string $email,
        string $nickname,
        array $roles,
        string $plainPassword,
        UserPasswordHasherInterface $passwordHasher
    ): User {
        $user = (new User())
            ->setEmail($email)
            ->setNickname($nickname)
            ->setRoles($roles);
        $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));

        $this->entityManager->persist($user);

        return $user;
    }
}
