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

    private const ROWS = [
            [
                'id' => 1,
                'title' => 'Cyberpunk 2077',
                'status' => 'Published',
                'slug' => 'cyberpunk-2077',
                'content' => 'Cyberpunk 2077 is an open-world action RPG set in Night City, a megalopolis obsessed with power, glamour, and body modification. You play as V, a mercenary outlaw chasing a one-of-a-kind implant that is the key to immortality. The choices you make shape the story and the world around you.

After a rough launch in 2020, CD Projekt Red spent years rebuilding the game. The 2.0 update and Phantom Liberty expansion in 2023 overhauled the police system, skill trees, and vehicle combat, adding a compelling spy-thriller storyline set in the new district of Dogtown.

With over 25 million copies sold, Cyberpunk 2077 is now considered one of the best RPGs of its generation — a redemption story as compelling as the game itself.',
                'summary' => 'An open-world RPG set in the dystopian Night City. Play as V, a mercenary fighting for survival and immortality in a world of megacorporations and high technology.',
                'release_date_world' => '2020-12-10',
                'release_date_france' => '2020-12-10',
                'platform_requirements_level' => 'High',
                'age_rating' => '18+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'ru',
                    'pl',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=8X2kIfS6fb8',
                'website' => 'https://www.cyberpunk.net',
                'created_at' => '2025-01-10 12:00:00',
                'updated_at' => '2026-04-21 20:56:15',
                'developers' => [
                    1,
                ],
                'genres' => [
                    1,
                    4,
                ],
                'platforms' => [
                    1,
                    2,
                    3,
                    4,
                ],
                'publishers' => [
                    1,
                ],
            ],
            [
                'id' => 2,
                'title' => 'Elden Ring',
                'status' => 'Published',
                'slug' => 'elden-ring',
                'content' => 'Elden Ring is an action RPG developed by FromSoftware in collaboration with fantasy author George R.R. Martin, who provided the world\'s lore and mythos. Set in the Lands Between, players take on the role of a Tarnished, an outcast summoned back to restore the shattered Elden Ring and become the Elden Lord.

The game expands on FromSoftware\'s signature challenging combat with a fully open world, mounted exploration on a spectral steed, and a vast underground map to discover. Its interconnected legacy dungeons are some of the most intricately designed environments in gaming history.

Elden Ring won Game of the Year at The Game Awards 2022 and sold over 20 million copies, cementing FromSoftware\'s place as one of the most influential studios in the industry.',
                'summary' => 'An open-world action RPG by FromSoftware and George R.R. Martin. Explore the Lands Between, conquer fearsome bosses, and claim the shattered Elden Ring.',
                'release_date_world' => '2022-02-25',
                'release_date_france' => '2022-02-25',
                'platform_requirements_level' => 'Medium',
                'age_rating' => '16+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'ja',
                    'ru',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=E3Huy2cdih0',
                'website' => 'https://en.bandainamcoent.eu/elden-ring',
                'created_at' => '2025-01-12 12:00:00',
                'updated_at' => '2025-01-12 12:00:00',
                'developers' => [
                    2,
                ],
                'genres' => [
                    1,
                    2,
                    5,
                ],
                'platforms' => [
                    1,
                    2,
                    3,
                    4,
                ],
                'publishers' => [
                    2,
                ],
            ],
            [
                'id' => 3,
                'title' => 'The Witcher 3: Wild Hunt',
                'status' => 'Published',
                'slug' => 'the-witcher-3',
                'content' => 'The Witcher 3: Wild Hunt is an open-world RPG following Geralt of Rivia, a monster hunter for hire, as he searches for his missing adopted daughter across a war-ravaged fantasy world. The game\'s main questline is interwoven with two massive expansions — Hearts of Stone and Blood and Wine — that together add over 50 hours of content.

The world of The Witcher 3 is alive with detail: every village has its own troubles, every contract tells a story, and the choices players make have meaningful consequences. The game redefined storytelling standards for open-world RPGs.

With over 50 million copies sold across all platforms, The Witcher 3 remains a benchmark of the genre more than a decade after release. The next-gen update in 2022 brought ray tracing, faster loading, and hundreds of visual improvements.',
                'summary' => 'Follow Geralt of Rivia across a vast open world teeming with monsters, politics, and moral choices. The gold standard of open-world RPG storytelling.',
                'release_date_world' => '2015-05-19',
                'release_date_france' => '2015-05-19',
                'platform_requirements_level' => 'Medium',
                'age_rating' => '18+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/292030/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'pl',
                    'ru',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=c0i88t0Kacs',
                'website' => 'https://www.thewitcher.com',
                'created_at' => '2025-01-14 12:00:00',
                'updated_at' => '2025-01-14 12:00:00',
                'developers' => [
                    1,
                ],
                'genres' => [
                    1,
                    4,
                ],
                'platforms' => [
                    1,
                    2,
                    3,
                    5,
                ],
                'publishers' => [
                    1,
                ],
            ],
            [
                'id' => 4,
                'title' => 'Red Dead Redemption 2',
                'status' => 'Published',
                'slug' => 'red-dead-redemption-2',
                'content' => 'Red Dead Redemption 2 is an epic open-world western developed by Rockstar Games. Set in 1899, it tells the story of Arthur Morgan, an outlaw in the Van der Linde gang, navigating the decline of the American frontier as federal agents and rival gangs close in from all sides.

The game features one of the most detailed open worlds ever created, with dynamic weather, realistic animal behavior, and a living ecosystem. Every character interaction, from bar fights to chance encounters in the wilderness, feels grounded and authentic.

Red Dead Redemption 2 won numerous Game of the Year awards and is widely considered one of the greatest games ever made. Its online component, Red Dead Online, continues to receive updates years after launch.',
                'summary' => 'An epic western adventure following outlaw Arthur Morgan as he navigates survival, loyalty, and the end of an era in a breathtaking open world.',
                'release_date_world' => '2018-10-26',
                'release_date_france' => '2018-10-26',
                'platform_requirements_level' => 'High',
                'age_rating' => '18+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1174180/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'es',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=gmA6MrX81z4',
                'website' => 'https://www.rockstargames.com/reddeadredemption2',
                'created_at' => '2025-01-16 12:00:00',
                'updated_at' => '2025-01-16 12:00:00',
                'developers' => [
                    3,
                ],
                'genres' => [
                    2,
                    3,
                    4,
                ],
                'platforms' => [
                    1,
                    3,
                    4,
                ],
                'publishers' => [
                    3,
                ],
            ],
            [
                'id' => 5,
                'title' => 'God of War: Ragnarok',
                'status' => 'Published',
                'slug' => 'god-of-war-ragnarok',
                'content' => 'God of War: Ragnarok is the direct sequel to the 2018 reboot, continuing the story of Kratos and his teenage son Atreus across the Nine Realms of Norse mythology. The game picks up three years after the events of the first game, with Fimbulwinter — the great winter preceding Ragnarok — already underway.

The combat system has been expanded with new weapons, abilities, and shield mechanics. Atreus becomes a fully playable character in several pivotal sections, allowing the story to explore his perspective and coming-of-age journey in depth.

Released on PlayStation 4 and 5, Ragnarok won multiple Game of the Year awards and was praised as one of the best action-adventure games ever crafted, combining spectacular set pieces with genuine emotional depth.',
                'summary' => 'Continue the journey of Kratos and Atreus through the Norse realms as they face the coming of Ragnarok and the inevitable clash with the Aesir gods.',
                'release_date_world' => '2022-11-09',
                'release_date_france' => '2022-11-09',
                'platform_requirements_level' => 'Medium',
                'age_rating' => '18+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/2322010/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'es',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=EE-4GvjKcfs',
                'website' => 'https://www.playstation.com/en-us/games/god-of-war-ragnarok',
                'created_at' => '2025-01-18 12:00:00',
                'updated_at' => '2025-01-18 12:00:00',
                'developers' => [
                    4,
                ],
                'genres' => [
                    2,
                    3,
                ],
                'platforms' => [
                    2,
                    3,
                ],
                'publishers' => [
                    4,
                ],
            ],
            [
                'id' => 6,
                'title' => 'Baldur\'s Gate 3',
                'status' => 'Published',
                'slug' => 'baldurs-gate-3',
                'content' => 'Baldur\'s Gate 3 is a story-rich party-based RPG developed by Larian Studios, set in the Forgotten Realms of Dungeons & Dragons. Players and up to three friends can create characters, gather a party of companions, and embark on a journey through Faer&#x00FB;n — from the depths of the Underdark to the shining city of Baldur\'s Gate itself.

The game adapts the D&D 5th Edition ruleset with remarkable fidelity, translating the freedom of tabletop roleplaying into a video game with branching dialogue, environmental storytelling, and combat that rewards creative thinking. Characters can be romanced, betrayed, or sacrificed — the world reacts to every choice.

Baldur\'s Gate 3 won Game of the Year 2023 at The Game Awards and is considered a landmark achievement in RPG design, selling over 10 million copies within its first year.',
                'summary' => 'A sprawling RPG set in the Forgotten Realms. Gather your party, roll for initiative, and forge your own path through a world of magic, mystery, and consequence.',
                'release_date_world' => '2023-08-03',
                'release_date_france' => '2023-08-03',
                'platform_requirements_level' => 'Medium',
                'age_rating' => '18+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1086940/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'es',
                    'ru',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=s8xfS2CiJNs',
                'website' => 'https://baldursgate3.game',
                'created_at' => '2025-01-20 12:00:00',
                'updated_at' => '2025-01-20 12:00:00',
                'developers' => [
                    5,
                ],
                'genres' => [
                    1,
                    6,
                ],
                'platforms' => [
                    1,
                    2,
                ],
                'publishers' => [
                    5,
                ],
            ],
            [
                'id' => 7,
                'title' => 'Hollow Knight',
                'status' => 'Published',
                'slug' => 'hollow-knight',
                'content' => 'Hollow Knight is a challenging 2D action-adventure game developed by Team Cherry, an independent studio of just three people. Set in Hallownest, a vast underground kingdom of insects, the game follows a silent knight exploring labyrinthine tunnels and ruins to uncover the kingdom\'s ancient secrets.

The game is renowned for its hand-drawn art style, tight and responsive controls, and a sprawling interconnected world designed in the Metroidvania tradition. Combat is precise and demanding, with boss fights that have become legendary among fans of the genre.

Hollow Knight sold over 5 million copies and is widely celebrated as one of the greatest indie games ever made. Its sequel, Hollow Knight: Silksong, is one of the most anticipated games in development.',
                'summary' => 'Explore the vast underground kingdom of Hallownest in this challenging 2D Metroidvania. Beautiful, mysterious, and brutally unforgiving.',
                'release_date_world' => '2017-02-24',
                'release_date_france' => '2017-02-24',
                'platform_requirements_level' => 'Low',
                'age_rating' => '7+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/367520/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'ru',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=UAO2urG23S4',
                'website' => 'https://www.hollowknight.com',
                'created_at' => '2025-01-22 12:00:00',
                'updated_at' => '2025-01-22 12:00:00',
                'developers' => [
                    7,
                ],
                'genres' => [
                    2,
                    7,
                ],
                'platforms' => [
                    1,
                    3,
                    5,
                ],
                'publishers' => [
                    6,
                ],
            ],
            [
                'id' => 8,
                'title' => 'Hades',
                'status' => 'Deleted',
                'slug' => 'hades',
                'content' => '<div>Hades is a rogue-like dungeon crawler developed by Supergiant Games in which you play as Zagreus, immortal son of the God of the Dead, attempting to escape from the Underworld. Each run through Tartarus, Asphodel, and Elysium is unique, fueled by a combination of powerful boons from the Olympian gods and a rich cast of mythological characters. What sets Hades apart is its narrative integration: every death advances the story, with new dialogue, revelations, and relationship developments. The writing is sharp and witty, making each failed escape attempt feel meaningful rather than frustrating. Hades won numerous awards including Best Action Game and Best Indie Game at The Game Awards 2020. It was the first video game to win a Hugo Award, cementing its status as a cultural landmark.</div>',
                'summary' => '<div>Play as Zagreus and battle your way out of the Underworld in this genre-defining rogue-like. Every run tells a story; every death makes you stronger.</div>',
                'release_date_world' => '2020-09-17',
                'release_date_france' => '2020-09-17',
                'platform_requirements_level' => 'Low',
                'age_rating' => '12+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1145360/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'ru',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=91t0ha9x0AE',
                'website' => 'https://www.supergiantgames.com/games/hades',
                'created_at' => '2025-01-24 12:00:00',
                'updated_at' => '2026-04-21 20:15:27',
                'developers' => [
                    8,
                ],
                'genres' => [
                    1,
                    2,
                ],
                'platforms' => [
                    1,
                    2,
                    3,
                    4,
                    5,
                ],
                'publishers' => [
                    7,
                ],
            ],
            [
                'id' => 9,
                'title' => 'Black Myth: Wukong',
                'status' => 'Archived',
                'slug' => 'black-myth-wukong',
                'content' => '<div>Black Myth: Wukong is an action RPG developed by Game Science, inspired by the 16th-century Chinese novel Journey to the West. Players take on the role of the Destined One, a monkey warrior who must battle mythological creatures and powerful bosses to uncover the truth behind the legendary Sun Wukong\'s legacy. The game features fast-paced, staff-based combat with shapeshifting abilities, drawing mechanics from Souls-like games while maintaining a distinct identity. Its visual fidelity on PC and PlayStation 5 is considered among the best of any game released in 2024. Black Myth: Wukong became the best-selling Chinese game of all time, selling over 10 million copies in its first three days. It opened a new chapter for the Chinese game development industry on the global stage.</div>',
                'summary' => '<div>An action RPG rooted in Chinese mythology. Master the staff, transform into mythical creatures, and uncover the legacy of the Great Sage, Sun Wukong.</div>',
                'release_date_world' => '2024-08-20',
                'release_date_france' => '2024-08-20',
                'platform_requirements_level' => 'High',
                'age_rating' => '16+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/2358720/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'zh',
                    'ru',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=lvOu8Xt7JVc',
                'website' => 'https://www.heishouyouxi.com/wukong',
                'created_at' => '2025-01-26 12:00:00',
                'updated_at' => '2026-04-21 20:14:51',
                'developers' => [
                    9,
                ],
                'genres' => [
                    1,
                    2,
                ],
                'platforms' => [
                    1,
                    2,
                ],
                'publishers' => [
                    8,
                ],
            ],
            [
                'id' => 10,
                'title' => 'Sekiro: Shadows Die Twice',
                'status' => 'Draft',
                'slug' => 'sekiro-shadows-die-twice',
                'content' => '<div>Sekiro: Shadows Die Twice is an action-adventure game developed by FromSoftware set in a reimagined late Sengoku-era Japan. Players control Wolf, a shinobi tasked with rescuing his kidnapped lord and taking revenge on the samurai clan that severed his arm. Unlike FromSoftware\'s Soulsborne games, Sekiro focuses on a single fixed protagonist with a defined skillset. Combat centers on a posture-breaking system that rewards aggressive play and precise parrying over cautious distance management. The result is one of the most demanding and satisfying combat systems ever designed. Sekiro won Game of the Year at The Game Awards 2019. Despite its punishing difficulty, it remains one of the highest-rated games of its generation and is praised for its extraordinary mechanical depth.</div>',
                'summary' => '<div>Master the way of the shinobi in feudal Japan. Sekiro\'s uncompromising combat system rewards patience, aggression, and perfect timing above all else.</div>',
                'release_date_world' => '2019-03-22',
                'release_date_france' => '2019-03-22',
                'platform_requirements_level' => 'Medium',
                'age_rating' => '18+',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/814380/header.jpg',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'ja',
                ],
                'screenshot' => NULL,
                'trailer' => 'https://www.youtube.com/watch?v=rXMX4YJ7Lks',
                'website' => 'https://www.sekirothegame.com',
                'created_at' => '2025-01-28 12:00:00',
                'updated_at' => '2026-04-21 20:14:09',
                'developers' => [
                    2,
                ],
                'genres' => [
                    2,
                    3,
                ],
                'platforms' => [
                    1,
                    2,
                    3,
                    4,
                ],
                'publishers' => [
                    2,
                ],
            ],
            [
                'id' => 11,
                'title' => 'Silent Hill f',
                'status' => 'Published',
                'slug' => 'silent-hill-f',
                'content' => '<div>Silent Hill f is a psychological survival horror game developed by NeoBards Entertainment and published by Konami Digital Entertainment. Set in 1960s Japan, the story follows Shimizu Hinako, a teenage girl from the secluded town of Ebisugaoka. When the town is consumed by a sudden fog, Hinako must explore its twisted streets, solve puzzles, and confront grotesque creatures. The game presents a self-contained story in the Silent Hill universe, combining Japanese horror, psychological mystery, and themes of beauty, fear, regret, and inescapable choices.</div>',
                'summary' => '<div>Silent Hill f is a psychological survival horror game set in 1960s Japan. Hinako Shimizu’s hometown is swallowed by fog, forcing her to face monsters, solve puzzles, and survive a story built around fear, beauty, and difficult choices.</div>',
                'release_date_world' => '2025-09-25',
                'release_date_france' => '2025-09-25',
                'platform_requirements_level' => 'High',
                'age_rating' => '18+',
                'cover' => '45a8fabf3c5e5c6fe82e068aab6bb8e37d8034b8.jpg',
                'language' => [
                    'en',
                    'ja',
                    'fr',
                    'de',
                    'it',
                    'ko',
                    'pl',
                    'ru',
                    'es',
                ],
                'screenshot' => NULL,
                'trailer' => NULL,
                'website' => NULL,
                'created_at' => '2026-04-21 20:23:29',
                'updated_at' => '2026-04-21 20:51:25',
                'developers' => [
                    11,
                ],
                'genres' => [
                    9,
                ],
                'platforms' => [
                    1,
                    2,
                    4,
                    6,
                ],
                'publishers' => [
                    9,
                ],
            ],
            [
                'id' => 12,
                'title' => 'Silent Hill 2 Remake',
                'status' => 'Published',
                'slug' => 'silent-hill-2-remake',
                'content' => '<div>Silent Hill 2 is a psychological survival horror game developed by Bloober Team and published by Konami Digital Entertainment. It is a remake of the 2001 classic and follows James Sunderland, who receives a letter from his dead wife, Mary, asking him to come to the town of Silent Hill. As James searches the fog-covered streets, he encounters disturbing creatures, hostile locations, and people connected to their own guilt and trauma. The remake keeps the core story of the original while updating the visuals, sound, combat, camera, and atmosphere for modern platforms.</div>',
                'summary' => '<div>Silent Hill 2 is a psychological survival horror remake about James Sunderland, who travels to Silent Hill after receiving a letter from his dead wife. The game keeps the original story while modernizing its visuals, combat, and atmosphere.</div>',
                'release_date_world' => '2024-10-08',
                'release_date_france' => '2024-10-08',
                'platform_requirements_level' => 'High',
                'age_rating' => '18+',
                'cover' => 'c3e96ba7f693d44aaec57b902327bf4f62a47a2b.png',
                'language' => [
                    'en',
                    'fr',
                    'de',
                    'ja',
                ],
                'screenshot' => NULL,
                'trailer' => NULL,
                'website' => NULL,
                'created_at' => '2026-04-21 20:44:58',
                'updated_at' => '2026-04-21 20:44:58',
                'developers' => [],
                'genres' => [
                    9,
                ],
                'platforms' => [
                    1,
                    2,
                ],
                'publishers' => [
                    9,
                ],
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $game = (new Game())
                ->setTitle($row['title'])
                ->setStatus(StatusEnum::from($row['status']))
                ->setSlug($row['slug'])
                ->setContent($row['content'])
                ->setSummary($row['summary'])
                ->setReleaseDateWorld($row['release_date_world'] ? new \DateTimeImmutable($row['release_date_world']) : null)
                ->setReleaseDateFrance($row['release_date_france'] ? new \DateTimeImmutable($row['release_date_france']) : null)
                ->setPlatformRequirementsLevel(PlatformRequirementsLevelEnum::from($row['platform_requirements_level']))
                ->setAgeRating(AgeRatingEnum::from($row['age_rating']))
                ->setCover($row['cover'])
                ->setLanguage($row['language'])
                ->setScreenshot($row['screenshot'])
                ->setTrailer($row['trailer'])
                ->setWebsite($row['website']);

            foreach ($row['developers'] as $developerId) {
                $game->addDeveloper($this->getReference('developer_' . $developerId, Developer::class));
            }

            foreach ($row['genres'] as $genreId) {
                $game->addGenre($this->getReference('genre_' . $genreId, Genre::class));
            }

            foreach ($row['platforms'] as $platformId) {
                $game->addPlatform($this->getReference('platform_' . $platformId, Platform::class));
            }

            foreach ($row['publishers'] as $publisherId) {
                $game->addPublisher($this->getReference('publisher_' . $publisherId, Publisher::class));
            }

            $this->setEntityTimestamps(
                $game,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($game);
            $this->addReference('game_' . $row['id'], $game);
        }

        $manager->flush();
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