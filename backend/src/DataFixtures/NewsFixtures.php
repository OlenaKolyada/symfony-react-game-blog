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

    private const ROWS = [
            [
                'id' => 1,
                'author_id' => 1,
                'title' => 'Cyberpunk 2077 Expansion Pushes Past Major Sales Milestone',
                'slug' => 'cyberpunk-2077-expansion-sales-milestone',
                'content' => 'The post-launch expansion for Cyberpunk 2077 has continued to perform strongly in the market, crossing a significant sales threshold that few standalone DLC products ever reach. CD Projekt Red confirmed the figures in a quarterly investor update, describing the results as exceeding internal projections.

Much of the expansion\'s commercial success has been attributed to the simultaneous release of a sweeping gameplay overhaul that addressed long-standing criticisms of the base game. The combination drew back lapsed players and attracted newcomers, resulting in some of the highest concurrent player counts the game had seen since launch.

The studio has indicated that no further major expansions are planned for this title, with resources now directed toward the next project in the pipeline. However, the game itself will continue to receive smaller maintenance updates for the foreseeable future.',
                'summary' => 'CD Projekt Red\'s expansion for Cyberpunk 2077 surpassed a major commercial milestone, fueled by strong player engagement following the simultaneous release of a major gameplay update.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg',
                'status' => 'Published',
                'created_at' => '2025-02-01 10:00:00',
                'updated_at' => '2025-02-01 10:00:00',
                'tags' => [
                    1,
                    7,
                ],
                'games' => [
                    1,
                ],
            ],
            [
                'id' => 2,
                'author_id' => 1,
                'title' => 'Elden Ring DLC Sets New Benchmark for Expansion Content',
                'slug' => 'elden-ring-dlc-benchmark',
                'content' => 'The first major paid expansion for Elden Ring has established a new commercial benchmark for DLC products in the action RPG space, according to sales data released by the publisher. The figures represent the fastest opening week for any expansion in the studio\'s catalog.

The expansion introduces a substantial new region with its own progression mechanics layered on top of the base game systems. Early player feedback has been polarized on difficulty, with many praising the ambition of the encounter design while others questioned whether the challenge had been calibrated appropriately for the intended audience.

Critics have largely been enthusiastic, with several noting that the new content expands meaningfully on the world\'s lore while providing dozens of additional hours for players who completed the main campaign. The studio has not yet indicated plans for additional paid content.',
                'summary' => 'Elden Ring\'s first paid expansion posted record-breaking opening sales figures, setting a new standard for what players can expect from action RPG downloadable content.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg',
                'status' => 'Published',
                'created_at' => '2025-02-05 10:00:00',
                'updated_at' => '2025-02-05 10:00:00',
                'tags' => [
                    2,
                    6,
                ],
                'games' => [
                    2,
                    7,
                ],
            ],
            [
                'id' => 3,
                'author_id' => 2,
                'title' => 'New Witcher Title Transitions Into Full Development Phase',
                'slug' => 'new-witcher-title-full-development',
                'content' => 'CD Projekt Red has announced that the next installment in the Witcher franchise has formally entered full production, marking a transition from the pre-production and prototyping phase that the project has been in for the past two years. The studio shared the update as part of a broader company roadmap presentation.

The new title will shift the series\' protagonist focus, introducing a different lead character with connections to the existing lore. The narrative will be built to function as both a continuation for longtime fans and an accessible entry point for players new to the world.

Development is proceeding on an engine that represents a significant technical departure from the studio\'s previous projects. The team has expressed confidence that the switch will result in improvements to development efficiency and final visual quality, though no release window has been announced.',
                'summary' => 'The next Witcher game has officially moved into full production at CD Projekt Red, with a new protagonist and a different engine powering the experience.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/292030/header.jpg',
                'status' => 'Published',
                'created_at' => '2025-02-10 10:00:00',
                'updated_at' => '2025-02-10 10:00:00',
                'tags' => [
                    3,
                    9,
                ],
                'games' => [
                    3,
                ],
            ],
            [
                'id' => 4,
                'author_id' => 2,
                'title' => 'Rockstar Confirms Release Period for Long-Awaited Open-World Sequel',
                'slug' => 'rockstar-open-world-sequel-release',
                'content' => 'Rockstar Games has confirmed a release period for its next open-world title, ending a period of extended speculation among the gaming community. The confirmation came via an official update that included new details about the game\'s setting and playable cast.

The game is set in a fictional recreation of a sun-drenched American city and surrounding region, and will feature two playable protagonists whose stories intertwine across the main narrative. Early materials suggest a significant leap in environmental detail and NPC behavior compared to the studio\'s previous output.

The title is targeting current-generation platforms at launch, with no immediate announcement regarding a PC version. Given the studio\'s previous release pattern, industry analysts expect a staggered release schedule, though Rockstar has not commented on post-launch platform availability.',
                'summary' => 'Rockstar Games has confirmed a release period for its next major open-world game, providing the first concrete timeline for one of the most anticipated titles in recent memory.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1174180/header.jpg',
                'status' => 'Published',
                'created_at' => '2025-02-15 10:00:00',
                'updated_at' => '2025-02-15 10:00:00',
                'tags' => [
                    1,
                    10,
                ],
                'games' => [
                    4,
                ],
            ],
            [
                'id' => 5,
                'author_id' => 3,
                'title' => 'Party-Based RPG Takes Top Honor at Annual Industry Awards',
                'slug' => 'party-rpg-takes-top-award',
                'content' => 'Larian Studios\' party-based role-playing game claimed the top prize at a prominent annual industry ceremony, capping a year in which it dominated sales charts and critical rankings across the genre. The studio founder accepted the award on behalf of the full development team.

The acceptance speech drew widespread attention for its candid remarks about working conditions in the industry and the importance of listening to community feedback during development. The game had benefited from an extended early access period during which player response shaped a number of key design decisions.

The win was notable given the strength of the competition, which included several high-profile titles from major publishers. The result was interpreted by many in the industry as a signal that production scale and marketing budgets are no longer reliable predictors of critical recognition.',
                'summary' => 'An independently published party-based RPG won the top prize at one of gaming\'s most prestigious annual ceremonies, edging out several high-profile releases.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1086940/header.jpg',
                'status' => 'Published',
                'created_at' => '2025-02-20 10:00:00',
                'updated_at' => '2025-02-20 10:00:00',
                'tags' => [
                    3,
                    4,
                ],
                'games' => [
                    8,
                ],
            ],
            [
                'id' => 6,
                'author_id' => 3,
                'title' => 'Chinese Action RPG Breaks Regional and Global Sales Records',
                'slug' => 'chinese-action-rpg-sales-records',
                'content' => 'A debut action RPG from a Chinese independent studio has set new records for the regional games industry, posting opening sales figures that no Chinese-developed title had previously achieved. The game sold several million copies within the first few days of its worldwide release across PC and console platforms.

The game\'s success has been attributed to a combination of exceptionally high visual quality, a combat system influenced by well-established action RPG conventions, and strong cultural resonance with its source material. Marketing materials released over a four-year development period built sustained international anticipation.

Analysts have noted that the result marks a meaningful shift in the global games market, suggesting that Chinese studios are now capable of competing at the highest commercial and critical level with established developers from Japan, North America, and Europe.',
                'summary' => 'A Chinese-developed action RPG posted record-breaking global sales on launch, marking a new era for the country\'s position in the premium games industry.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/2358720/header.jpg',
                'status' => 'Published',
                'created_at' => '2025-02-25 10:00:00',
                'updated_at' => '2025-02-25 10:00:00',
                'tags' => [
                    2,
                    9,
                ],
                'games' => [
                    5,
                ],
            ],
            [
                'id' => 7,
                'author_id' => 4,
                'title' => 'FromSoftware Studio Head Discusses Direction After Open-World Success',
                'slug' => 'fromsoftware-direction-after-open-world',
                'content' => 'Hidetaka Miyazaki, the studio head at FromSoftware, has discussed the direction of the company\'s next project in a rare extended interview, hinting that the team is inclined toward new creative territory rather than a direct follow-up to their most recent release.

Miyazaki described the studio\'s ongoing interest in subverting player expectations and cited the value of exploring unfamiliar settings and mechanics. While he did not provide specifics about the next project, he indicated that a formal announcement would come when the team felt the concept was ready to be shared publicly.

The comments have generated significant speculation in the gaming community, with fans proposing various interpretations of Miyazaki\'s phrasing. The studio has a track record of surprising its audience with significant departures between releases, and most observers expect the next title to diverge meaningfully from recent output.',
                'summary' => 'FromSoftware\'s Hidetaka Miyazaki has hinted that the studio\'s next game will explore new creative directions rather than directly continuing recent successful formulas.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/814380/header.jpg',
                'status' => 'Published',
                'created_at' => '2025-03-01 10:00:00',
                'updated_at' => '2025-03-01 10:00:00',
                'tags' => [
                    2,
                    6,
                ],
                'games' => [
                    9,
                ],
            ],
            [
                'id' => 8,
                'author_id' => 4,
                'title' => 'Action-Adventure Franchise Crosses Major Lifetime Sales Threshold',
                'slug' => 'action-adventure-franchise-lifetime-sales',
                'content' => '<div>Sony Interactive Entertainment has confirmed that one of its flagship action-adventure franchises has surpassed a significant lifetime sales milestone, reflecting the series\' continued relevance across multiple console generations. The announcement covered all entries in the franchise from its original release onward. The most recent mainline entry contributed substantially to the milestone, having sold exceptionally well since its launch on PlayStation hardware. The title was notable for its narrative ambition and the depth of its character writing, which drew comparisons to prestige television rather than conventional video game storytelling. A PC release of the most recent sequel has been confirmed for a future date, following the positive reception of its predecessor on that platform. No details regarding a follow-up entry in the franchise have been announced, though the studio has indicated that the property remains a priority.</div>',
                'summary' => '<div>One of PlayStation\'s most celebrated action-adventure franchises has crossed a major lifetime sales milestone, reflecting strong performance across multiple generations.</div>',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/2322010/header.jpg',
                'status' => 'Deleted',
                'created_at' => '2025-03-05 10:00:00',
                'updated_at' => '2026-04-21 20:09:29',
                'tags' => [
                    3,
                    5,
                ],
                'games' => [
                    10,
                ],
            ],
            [
                'id' => 9,
                'author_id' => 5,
                'title' => 'Anticipated Indie Sequel Remains in Development, Studio Confirms',
                'slug' => 'indie-sequel-development-confirmed',
                'content' => '<div>Team Cherry has provided a brief update confirming that development on the sequel to their acclaimed underground exploration game is continuing, following an extended period of near-silence from the studio. The update did not include a release date or detailed information about the current state of the project. The studio reiterated its commitment to delivering the game only when it meets the standard they have set for themselves, pointing to the extended development of the original title as evidence of their process. The sequel was first announced several years ago and has become one of the most discussed unreleased games in the independent games space. Community reaction to the update was mixed, with many players expressing understanding of the studio\'s small size and independent status, while others voiced frustration at the lack of concrete information. Team Cherry has not addressed the question of whether the scope of the project has grown beyond original intentions.</div>',
                'summary' => '<div>Team Cherry confirmed that their highly anticipated indie sequel is still in active development, though no release window or new gameplay details were shared.</div>',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/367520/header.jpg',
                'status' => 'Archived',
                'created_at' => '2025-03-10 10:00:00',
                'updated_at' => '2026-04-21 20:08:55',
                'tags' => [
                    5,
                    8,
                ],
                'games' => [
                    6,
                ],
            ],
            [
                'id' => 10,
                'author_id' => 5,
                'title' => 'Rogue-Like Sequel Enters Early Access to Strong Initial Response',
                'slug' => 'roguelike-sequel-early-access',
                'content' => '<div>Supergiant Games has launched the early access phase of the sequel to their award-winning rogue-like dungeon crawler, receiving an enthusiastic initial response from both critics and the player community. The early access build contains a substantial portion of the planned content, with additional story and gameplay content to be added throughout the access period. The sequel introduces a new protagonist and expands the scope of the original game\'s setting in ways that reviewers have described as both surprising and coherent with the existing lore. New mechanics including a broader ability set and a surface-world exploration component have been highlighted as significant additions to the formula. The studio has historically used the early access model to incorporate player feedback into the final product, a practice that was credited with improving several key systems in the original title before its full release. No estimated date for the completion of early access has been provided.</div>',
                'summary' => '<div>Supergiant Games\' sequel to their acclaimed rogue-like entered early access to strong reviews, introducing a new protagonist and expanded mechanics.</div>',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1145360/header.jpg',
                'status' => 'Draft',
                'created_at' => '2025-03-15 10:00:00',
                'updated_at' => '2026-04-21 20:07:30',
                'tags' => [
                    3,
                    8,
                ],
                'games' => [
                    7,
                ],
            ],
            [
                'id' => 11,
                'author_id' => 1,
                'title' => 'Silent Hill f brings Japanese horror to the series',
                'slug' => 'silent-hill-f-brings-japanese-horror-to-the-series',
                'content' => '<div>Supergiant Games has launched early access for the sequel to its award-winning rogue-like dungeon crawler. The first build has received a strong response from critics and players and already includes a large part of the planned content. The sequel introduces a new protagonist and expands the original game’s world while staying consistent with its lore. Reviewers have highlighted the broader ability set and new surface-world exploration as major additions to the formula. More story and gameplay content will be added during early access. Supergiant has used this model before to improve its games through player feedback, including the original title. No final release date has been announced.</div>',
                'summary' => '<div>Konami’s Silent Hill f moves the franchise to 1960s Japan, following Hinako Shimizu as her hometown is consumed by fog and nightmare.</div>',
                'cover' => 'e85080ad20a96d373a653bc1dbbdbff5d3de0cee.jpg',
                'status' => 'Published',
                'created_at' => '2026-04-21 20:47:59',
                'updated_at' => '2026-04-21 20:47:59',
                'tags' => [
                    5,
                ],
                'games' => [
                    11,
                ],
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $news = (new News())
                ->setTitle($row['title'])
                ->setSlug($row['slug'])
                ->setContent($row['content'])
                ->setSummary($row['summary'])
                ->setCover($row['cover'])
                ->setStatus(StatusEnum::from($row['status']))
                ->setAuthor($row['author_id'] ? $this->getReference('user_' . $row['author_id'], User::class) : null);

            foreach ($row['tags'] as $tagId) {
                $news->addTag($this->getReference('tag_' . $tagId, Tag::class));
            }

            foreach ($row['games'] as $gameId) {
                $news->addGame($this->getReference('game_' . $gameId, Game::class));
            }

            $this->setEntityTimestamps(
                $news,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($news);
            $this->addReference('news_' . $row['id'], $news);
        }

        $manager->flush();
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