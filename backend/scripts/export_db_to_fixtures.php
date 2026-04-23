<?php

declare(strict_types=1);

function parseDatabaseUrl(string $databaseUrl): array
{
    $parts = parse_url($databaseUrl);
    if ($parts === false) {
        throw new RuntimeException('Invalid DATABASE_URL');
    }

    return [
        'host' => $parts['host'] ?? 'db',
        'port' => $parts['port'] ?? 3306,
        'dbname' => ltrim($parts['path'] ?? '/grem', '/'),
        'user' => $parts['user'] ?? 'grem',
        'password' => $parts['pass'] ?? '',
    ];
}

function exportPhp(mixed $value, int $indent = 0): string
{
    $pad = str_repeat('    ', $indent);
    $nextPad = str_repeat('    ', $indent + 1);

    if (is_array($value)) {
        if ($value === []) {
            return '[]';
        }

        $isList = array_keys($value) === range(0, count($value) - 1);
        $lines = ["["];

        foreach ($value as $key => $item) {
            $line = $nextPad;
            if (!$isList) {
                $line .= var_export((string) $key, true) . ' => ';
            }
            $line .= exportPhp($item, $indent + 1) . ',';
            $lines[] = $line;
        }

        $lines[] = $pad . "]";

        return implode(PHP_EOL, $lines);
    }

    return var_export($value, true);
}

function writeFixture(string $path, string $content): void
{
    file_put_contents($path, $content);
    echo 'Wrote ' . $path . PHP_EOL;
}

$databaseUrl = getenv('DATABASE_URL');
if (!$databaseUrl) {
    throw new RuntimeException('DATABASE_URL is not set');
}

$config = parseDatabaseUrl($databaseUrl);
$dsn = sprintf(
    'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
    $config['host'],
    $config['port'],
    $config['dbname']
);

$pdo = new PDO(
    $dsn,
    $config['user'],
    $config['password'],
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

$fixturesDir = __DIR__ . '/../src/DataFixtures';

$fetchAll = static function (string $sql) use ($pdo): array {
    return $pdo->query($sql)->fetchAll();
};

$fetchMap = static function (string $sql, string $groupKey, string $valueKey) use ($pdo): array {
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $map = [];

    foreach ($rows as $row) {
        $map[(int) $row[$groupKey]][] = (int) $row[$valueKey];
    }

    return $map;
};

$developers = $fetchAll('SELECT * FROM developer ORDER BY id');
$genres = $fetchAll('SELECT * FROM genre ORDER BY id');
$platforms = $fetchAll('SELECT * FROM platform ORDER BY id');
$publishers = $fetchAll('SELECT * FROM publisher ORDER BY id');
$tags = $fetchAll('SELECT * FROM tag ORDER BY id');
$users = $fetchAll('SELECT * FROM user ORDER BY id');
$games = $fetchAll('SELECT * FROM game ORDER BY id');
$news = $fetchAll('SELECT * FROM news ORDER BY id');
$reviews = $fetchAll('SELECT * FROM review ORDER BY id');
$comments = $fetchAll('SELECT * FROM comment ORDER BY id');
$userTokens = $fetchAll('SELECT * FROM user_token ORDER BY id');

$gameDevelopers = $fetchMap('SELECT game_id, developer_id FROM game_developer ORDER BY game_id, developer_id', 'game_id', 'developer_id');
$gameGenres = $fetchMap('SELECT game_id, genre_id FROM game_genre ORDER BY game_id, genre_id', 'game_id', 'genre_id');
$gamePlatforms = $fetchMap('SELECT game_id, platform_id FROM game_platform ORDER BY game_id, platform_id', 'game_id', 'platform_id');
$gamePublishers = $fetchMap('SELECT game_id, publisher_id FROM game_publisher ORDER BY game_id, publisher_id', 'game_id', 'publisher_id');
$gameNews = $fetchMap('SELECT game_id, news_id FROM game_news ORDER BY game_id, news_id', 'game_id', 'news_id');
$gameReviews = $fetchMap('SELECT game_id, review_id FROM game_review ORDER BY game_id, review_id', 'game_id', 'review_id');
$newsTags = $fetchMap('SELECT news_id, tag_id FROM news_tag ORDER BY news_id, tag_id', 'news_id', 'tag_id');
$reviewTags = $fetchMap('SELECT review_id, tag_id FROM review_tag ORDER BY review_id, tag_id', 'review_id', 'tag_id');

foreach ($games as &$row) {
    $row['language'] = $row['language'] ? json_decode($row['language'], true, 512, JSON_THROW_ON_ERROR) : null;
    $row['screenshot'] = $row['screenshot'] ? json_decode($row['screenshot'], true, 512, JSON_THROW_ON_ERROR) : null;
    $row['developers'] = $gameDevelopers[(int) $row['id']] ?? [];
    $row['genres'] = $gameGenres[(int) $row['id']] ?? [];
    $row['platforms'] = $gamePlatforms[(int) $row['id']] ?? [];
    $row['publishers'] = $gamePublishers[(int) $row['id']] ?? [];
}
unset($row);

foreach ($news as &$row) {
    $row['tags'] = $newsTags[(int) $row['id']] ?? [];
    $row['games'] = $gameNews[(int) $row['id']] ?? [];
}
unset($row);

foreach ($reviews as &$row) {
    $row['tags'] = $reviewTags[(int) $row['id']] ?? [];
    $row['games'] = $gameReviews[(int) $row['id']] ?? [];
}
unset($row);

$developerRows = exportPhp($developers, 2);
$genreRows = exportPhp($genres, 2);
$platformRows = exportPhp($platforms, 2);
$publisherRows = exportPhp($publishers, 2);
$tagRows = exportPhp($tags, 2);
$userRows = exportPhp($users, 2);
$gameRows = exportPhp($games, 2);
$newsRows = exportPhp($news, 2);
$reviewRows = exportPhp($reviews, 2);
$commentRows = exportPhp($comments, 2);
$userTokenRows = exportPhp($userTokens, 2);

writeFixture($fixturesDir . '/DeveloperFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DeveloperFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = {$developerRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$developer = (new Developer())
                ->setTitle(\$row['title'])
                ->setSlug(\$row['slug'])
                ->setCountry(\$row['country'])
                ->setWebsite(\$row['website']);

            \$this->setEntityTimestamps(
                \$developer,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$developer);
            \$this->addReference('developer_' . \$row['id'], \$developer);
        }

        \$manager->flush();
    }
}
PHP
);

writeFixture($fixturesDir . '/GenreFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = {$genreRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$genre = (new Genre())
                ->setTitle(\$row['title'])
                ->setSlug(\$row['slug']);

            \$this->setEntityTimestamps(
                \$genre,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$genre);
            \$this->addReference('genre_' . \$row['id'], \$genre);
        }

        \$manager->flush();
    }
}
PHP
);

writeFixture($fixturesDir . '/PlatformFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\Platform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlatformFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = {$platformRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$platform = (new Platform())
                ->setTitle(\$row['title'])
                ->setSlug(\$row['slug']);

            \$this->setEntityTimestamps(
                \$platform,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$platform);
            \$this->addReference('platform_' . \$row['id'], \$platform);
        }

        \$manager->flush();
    }
}
PHP
);

writeFixture($fixturesDir . '/PublisherFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\Publisher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PublisherFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = {$publisherRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$publisher = (new Publisher())
                ->setTitle(\$row['title'])
                ->setSlug(\$row['slug'])
                ->setCountry(\$row['country'])
                ->setWebsite(\$row['website']);

            \$this->setEntityTimestamps(
                \$publisher,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$publisher);
            \$this->addReference('publisher_' . \$row['id'], \$publisher);
        }

        \$manager->flush();
    }
}
PHP
);

writeFixture($fixturesDir . '/TagFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = {$tagRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$tag = (new Tag())
                ->setTitle(\$row['title'])
                ->setSlug(\$row['slug']);

            \$this->setEntityTimestamps(
                \$tag,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$tag);
            \$this->addReference('tag_' . \$row['id'], \$tag);
        }

        \$manager->flush();
    }
}
PHP
);

writeFixture($fixturesDir . '/UserFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = {$userRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$user = (new User())
                ->setNickname(\$row['nickname'])
                ->setEmail(\$row['email'])
                ->setRoles(json_decode(\$row['roles'], true, 512, JSON_THROW_ON_ERROR))
                ->setPassword(\$row['password'])
                ->setTwitchAccount(\$row['twitch_account'])
                ->setAvatar(\$row['avatar']);

            \$this->setEntityTimestamps(
                \$user,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$user);
            \$this->addReference('user_' . \$row['id'], \$user);
        }

        \$manager->flush();
    }
}
PHP
);

writeFixture($fixturesDir . '/GameFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use App\Entity\Game;
use App\Entity\Genre;
use App\Entity\Platform;
use App\Entity\Publisher;
use App\Enum\AgeRatingEnum;
use App\Enum\PlatformRequirementsLevelEnum;
use App\Enum\StatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture implements DependentFixtureInterface
{
    use EntityHelperTrait;

    private const ROWS = {$gameRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$game = (new Game())
                ->setTitle(\$row['title'])
                ->setStatus(StatusEnum::from(\$row['status']))
                ->setSlug(\$row['slug'])
                ->setContent(\$row['content'])
                ->setSummary(\$row['summary'])
                ->setReleaseDateWorld(\$row['release_date_world'] ? new \\DateTimeImmutable(\$row['release_date_world']) : null)
                ->setReleaseDateFrance(\$row['release_date_france'] ? new \\DateTimeImmutable(\$row['release_date_france']) : null)
                ->setPlatformRequirementsLevel(PlatformRequirementsLevelEnum::from(\$row['platform_requirements_level']))
                ->setAgeRating(AgeRatingEnum::from(\$row['age_rating']))
                ->setCover(\$row['cover'])
                ->setLanguage(\$row['language'])
                ->setScreenshot(\$row['screenshot'])
                ->setTrailer(\$row['trailer'])
                ->setWebsite(\$row['website']);

            foreach (\$row['developers'] as \$developerId) {
                \$game->addDeveloper(\$this->getReference('developer_' . \$developerId, Developer::class));
            }

            foreach (\$row['genres'] as \$genreId) {
                \$game->addGenre(\$this->getReference('genre_' . \$genreId, Genre::class));
            }

            foreach (\$row['platforms'] as \$platformId) {
                \$game->addPlatform(\$this->getReference('platform_' . \$platformId, Platform::class));
            }

            foreach (\$row['publishers'] as \$publisherId) {
                \$game->addPublisher(\$this->getReference('publisher_' . \$publisherId, Publisher::class));
            }

            \$this->setEntityTimestamps(
                \$game,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$game);
            \$this->addReference('game_' . \$row['id'], \$game);
        }

        \$manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            DeveloperFixtures::class,
            GenreFixtures::class,
            PlatformFixtures::class,
            PublisherFixtures::class,
        ];
    }
}
PHP
);

writeFixture($fixturesDir . '/NewsFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\News;
use App\Entity\Tag;
use App\Entity\User;
use App\Enum\StatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class NewsFixtures extends Fixture implements DependentFixtureInterface
{
    use EntityHelperTrait;

    private const ROWS = {$newsRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$news = (new News())
                ->setTitle(\$row['title'])
                ->setSlug(\$row['slug'])
                ->setContent(\$row['content'])
                ->setSummary(\$row['summary'])
                ->setCover(\$row['cover'])
                ->setStatus(StatusEnum::from(\$row['status']))
                ->setAuthor(\$row['author_id'] ? \$this->getReference('user_' . \$row['author_id'], User::class) : null);

            foreach (\$row['tags'] as \$tagId) {
                \$news->addTag(\$this->getReference('tag_' . \$tagId, Tag::class));
            }

            foreach (\$row['games'] as \$gameId) {
                \$news->addGame(\$this->getReference('game_' . \$gameId, Game::class));
            }

            \$this->setEntityTimestamps(
                \$news,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$news);
            \$this->addReference('news_' . \$row['id'], \$news);
        }

        \$manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
            GameFixtures::class,
            UserFixtures::class,
        ];
    }
}
PHP
);

writeFixture($fixturesDir . '/ReviewFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\Review;
use App\Entity\Tag;
use App\Entity\User;
use App\Enum\StatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    use EntityHelperTrait;

    private const ROWS = {$reviewRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$review = (new Review())
                ->setTitle(\$row['title'])
                ->setSlug(\$row['slug'])
                ->setAuthor(\$row['author_id'] ? \$this->getReference('user_' . \$row['author_id'], User::class) : null)
                ->setContent(\$row['content'])
                ->setSummary(\$row['summary'])
                ->setCover(\$row['cover'])
                ->setGameRating((int) \$row['game_rating'])
                ->setStatus(StatusEnum::from(\$row['status']));

            foreach (\$row['tags'] as \$tagId) {
                \$review->addTag(\$this->getReference('tag_' . \$tagId, Tag::class));
            }

            foreach (\$row['games'] as \$gameId) {
                \$review->addGame(\$this->getReference('game_' . \$gameId, Game::class));
            }

            \$this->setEntityTimestamps(
                \$review,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$review);
            \$this->addReference('review_' . \$row['id'], \$review);
        }

        \$manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
            GameFixtures::class,
            UserFixtures::class,
        ];
    }
}
PHP
);

writeFixture($fixturesDir . '/CommentFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Review;
use App\Entity\User;
use App\Enum\CommentStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    use EntityHelperTrait;

    private const ROWS = {$commentRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$comment = (new Comment())
                ->setContent(\$row['content'])
                ->setStatus(CommentStatusEnum::from(\$row['status']))
                ->setAuthor(\$row['author_id'] ? \$this->getReference('user_' . \$row['author_id'], User::class) : null)
                ->setReview(\$this->getReference('review_' . \$row['review_id'], Review::class));

            \$this->setEntityTimestamps(
                \$comment,
                new \\DateTimeImmutable(\$row['created_at']),
                new \\DateTimeImmutable(\$row['updated_at'])
            );

            \$manager->persist(\$comment);
            \$this->addReference('comment_' . \$row['id'], \$comment);
        }

        \$manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ReviewFixtures::class,
            UserFixtures::class,
        ];
    }
}
PHP
);

writeFixture($fixturesDir . '/UserTokenFixtures.php', <<<PHP
<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserToken;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserTokenFixtures extends Fixture implements DependentFixtureInterface
{
    private const ROWS = {$userTokenRows};

    public function load(ObjectManager \$manager): void
    {
        foreach (self::ROWS as \$row) {
            \$token = (new UserToken())
                ->setUser(\$this->getReference('user_' . \$row['user_id'], User::class))
                ->setToken(\$row['token'])
                ->setSessionId(\$row['session_id'])
                ->setExpiresAt(new \\DateTime(\$row['expires_at']))
                ->setRevoked((bool) \$row['is_revoked']);

            \$manager->persist(\$token);
        }

        \$manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
PHP
);
