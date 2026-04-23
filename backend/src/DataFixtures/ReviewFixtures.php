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

    private const ROWS = [
            [
                'id' => 1,
                'author_id' => 1,
                'title' => 'Cyberpunk 2077: A City Worth Getting Lost In',
                'slug' => 'cyberpunk-2077-review',
                'content' => 'Night City is one of the most visually dense urban environments ever constructed in a video game. Every street corner feels like it was designed by someone with a specific story in mind — the neon signs, the food stalls, the residents sitting in doorways. Walking through it without any objective in mind is a genuinely absorbing experience, and that alone justifies a significant portion of the time investment the game asks of you.

The core RPG loop has been meaningfully strengthened by a skills overhaul that arrived well after the initial release. Builds now feel genuinely distinct from one another, and the game rewards commitment to a chosen approach rather than punishing players for specializing. Whether you prefer to ghost through missions or approach them as a series of escalating firefights, the systems support both playstyles with enough depth to stay interesting.

The story, centered on a mercenary navigating a terminal diagnosis while hosting an increasingly intrusive digital passenger, is told with a confidence that the game\'s early reception obscured for too long. The final act in particular lands with real emotional weight, and multiple ending paths give the experience genuine replay value. Night City deserved a better launch than it got, but it deserves the attention it receives now.',
                'summary' => 'Night City finally gets the game it deserved. Cyberpunk 2077 has matured into a compelling open-world RPG with strong writing and genuinely distinct build options.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1091500/capsule_616x353.jpg',
                'game_rating' => 9,
                'status' => 'Published',
                'created_at' => '2025-04-01 10:00:00',
                'updated_at' => '2025-04-01 10:00:00',
                'tags' => [
                    1,
                    7,
                    9,
                ],
                'games' => [
                    1,
                    11,
                ],
            ],
            [
                'id' => 2,
                'author_id' => 1,
                'title' => 'Elden Ring: Where Difficulty Meets Discovery',
                'slug' => 'elden-ring-review',
                'content' => 'The most important thing to understand about Elden Ring is that its difficulty is a feature of the exploration, not a barrier to it. Every time the game turns you back from a direction you were heading, it is implicitly pointing you somewhere else. The open world is a tool for managing your own progression in a way that few games have attempted and fewer have executed well.

Combat retains the deliberate, read-and-respond quality that defines this studio\'s output, but the variety of weapons, spells, and summon options creates a wider range of viable approaches than the studio\'s earlier works allowed. Players who struggled with previous entries will find the open-world structure genuinely accommodating without the game ever feeling like it has compromised on its identity.

The world design is exceptional. Each area has a visual identity and an implicit narrative told through enemy placement, item descriptions, and the ruined or inhabited state of the environments. Spending time piecing together what happened here before your character arrived is one of the game\'s primary pleasures. This is a substantial, carefully constructed work that more than justifies its reputation.',
                'summary' => 'Elden Ring reframes the studio\'s signature challenge within an open world that rewards curiosity and makes player-directed progression genuinely satisfying.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1245620/capsule_616x353.jpg',
                'game_rating' => 10,
                'status' => 'Published',
                'created_at' => '2025-02-07 10:00:00',
                'updated_at' => '2025-02-07 10:00:00',
                'tags' => [
                    2,
                    5,
                    6,
                ],
                'games' => [
                    2,
                ],
            ],
            [
                'id' => 3,
                'author_id' => 2,
                'title' => 'The Witcher 3: A Decade On and Still Unmatched',
                'slug' => 'the-witcher-3-review',
                'content' => 'Very few games of the past ten years have aged as well as The Witcher 3. Its open world remains one of the most carefully realized in the medium — not merely large, but populated with content that was clearly written by people who cared about the specific village, the specific characters, the specific problem at hand. The result is a world that feels inhabited rather than generated.

Geralt of Rivia is a reliable anchor for a sprawling narrative that moves between political intrigue, family drama, and monster hunting with unusual ease. The main storyline holds its shape across a runtime that many open-world games use as an excuse to pad. The two expansions extend the experience further, with one of them delivering a self-contained story that stands among the best the medium has produced.

The technical upgrades introduced in the current-generation version address many of the visual compromises that were apparent in the original release, making this the definitive way to experience a game that needed no improvement in any area that actually mattered. Required playing.',
                'summary' => 'The Witcher 3 holds up remarkably well a decade after release. Its world, characters, and narrative remain benchmarks that most open-world games still fail to reach.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/292030/capsule_616x353.jpg',
                'game_rating' => 10,
                'status' => 'Published',
                'created_at' => '2025-02-12 10:00:00',
                'updated_at' => '2025-02-12 10:00:00',
                'tags' => [
                    1,
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
                'title' => 'Red Dead Redemption 2: Patience as a Design Principle',
                'slug' => 'red-dead-redemption-2-review',
                'content' => 'Red Dead Redemption 2 is a game about the pace of a dying era, and it has the courage to make you feel that pace. Travel is slow. Conversations take as long as they need to. The camp you return to between missions changes gradually, and the people in it respond to your presence differently depending on how you have behaved. These are design choices that will frustrate players looking for constant stimulation, and they are exactly right for what the game is trying to accomplish.

Arthur Morgan is the most fully realized protagonist Rockstar has produced. His arc across the game\'s six chapters moves from competence to reflection to something approaching grace, and the writing supports every stage of that transition without forcing it. The late-game sections in particular achieve a register that most narrative games never attempt.

The world itself is a genuine achievement — not just in its visual fidelity, which is extraordinary, but in the density of its incidental content. Strangers you meet once deliver small stories with beginnings and ends. Animals behave according to their own logic. The frontier feels like a place that would exist without you, which is the highest compliment you can pay to an open world.',
                'summary' => 'Red Dead Redemption 2 commits fully to its slow, deliberate rhythm and is better for it. Arthur Morgan\'s story earns every hour it asks of you.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1174180/capsule_616x353.jpg',
                'game_rating' => 9,
                'status' => 'Published',
                'created_at' => '2025-02-17 10:00:00',
                'updated_at' => '2025-02-17 10:00:00',
                'tags' => [
                    1,
                    3,
                    10,
                ],
                'games' => [
                    4,
                ],
            ],
            [
                'id' => 5,
                'author_id' => 3,
                'title' => 'God of War Ragnarok: A Sequel That Earns Its Scale',
                'slug' => 'god-of-war-ragnarok-review',
                'content' => 'The challenge facing any sequel to a universally praised game is how to be more without simply being larger. God of War Ragnarok navigates this by deepening rather than widening — the relationship at its center is more complex, the moral questions are harder, and the narrative is willing to sit with ambiguity in a way that action games rarely attempt.

Kratos has become one of the medium\'s most interesting characters precisely because the game resists the temptation to resolve his contradictions. He is trying to be different from what he was, and the game acknowledges that trying and succeeding are not the same thing. The scenes between him and Atreus carry the weight of that effort, and the voice performances support it at every turn.

Combat is expanded from the previous entry in ways that feel considered rather than additive for its own sake. New weapon options and enemy designs encourage more varied approaches, and the spectacle of the larger set pieces is handled with a confidence that comes from a studio at the height of its technical ability. A very strong entry in a franchise that has reinvented itself successfully.',
                'summary' => 'God of War Ragnarok deepens its predecessor in ways that matter — stronger character work, harder questions, and combat that rewards the new tools it gives you.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/2322010/capsule_616x353.jpg',
                'game_rating' => 9,
                'status' => 'Published',
                'created_at' => '2025-02-22 10:00:00',
                'updated_at' => '2025-02-22 10:00:00',
                'tags' => [
                    3,
                    5,
                    6,
                ],
                'games' => [
                    5,
                ],
            ],
            [
                'id' => 6,
                'author_id' => 3,
                'title' => 'Baldur\'s Gate 3: The Tabletop Dream Realized',
                'slug' => 'baldurs-gate-3-review',
                'content' => 'The central promise of Baldur\'s Gate 3 is that the world will respond to what you do with the flexibility and creativity of a skilled dungeon master, and the remarkable thing is that it largely keeps that promise. Solutions present themselves from unexpected directions. Characters remember what you did and respond accordingly. The systems interact in ways that produce outcomes the designers clearly did not specifically script.

The companion writing is the game\'s most consistent strength. Each character arrives with a history and a perspective that resists easy summary, and the arcs they travel across the game\'s three acts feel earned rather than prescribed. The co-operative mode amplifies everything — four players making divergent choices produces a kind of emergent narrative chaos that the game absorbs with surprising grace.

Act three, set in the city the game is named after, is ambitious to the point of occasional incoherence, but the ambition itself is worth acknowledging. Few games attempt content at this scale while maintaining this level of quality in the writing. The result is imperfect and essential in equal measure.',
                'summary' => 'Baldur\'s Gate 3 keeps its central promise: the world responds to what you do with genuine flexibility. The companion writing and co-op experience are exceptional throughout.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1086940/capsule_616x353.jpg',
                'game_rating' => 10,
                'status' => 'Published',
                'created_at' => '2025-02-27 10:00:00',
                'updated_at' => '2025-02-27 10:00:00',
                'tags' => [
                    3,
                    4,
                    9,
                ],
                'games' => [
                    6,
                ],
            ],
            [
                'id' => 7,
                'author_id' => 4,
                'title' => 'Hollow Knight: Small Studio, Enormous World',
                'slug' => 'hollow-knight-review',
                'content' => 'Hallownest is a kingdom with the texture of a place that once mattered. Its architecture suggests a civilization with its own rituals and hierarchies; the enemies that now inhabit it carry the remnants of roles they no longer serve. Wandering through it is an act of archaeology as much as combat, and the game is designed to reward the player who pays attention to what the environment is saying.

The Metroidvania structure is executed with unusual discipline. New abilities open old paths in ways that feel logical rather than arbitrary, and the map — which you assemble manually using purchased pins — gives the navigation a tactile quality that most games in the genre skip past. Getting lost and finding your way out is part of the design, not a failure state.

Combat asks you to be precise and aggressive within a limited range. This is a deliberate constraint — the nail is short, enemies are numerous, and many encounters require you to stay close to things that are trying to hurt you. Boss fights build on this tension into encounters that are demanding and fair in equal measure. This is a game made with real conviction by people who cared deeply about every corner of it.',
                'summary' => 'Hollow Knight builds a world worth getting lost in, and fills it with combat that rewards the precision it demands. A genuine achievement from a tiny team.',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/367520/capsule_616x353.jpg',
                'game_rating' => 9,
                'status' => 'Published',
                'created_at' => '2025-03-03 10:00:00',
                'updated_at' => '2025-03-03 10:00:00',
                'tags' => [
                    5,
                    6,
                    8,
                ],
                'games' => [
                    7,
                ],
            ],
            [
                'id' => 8,
                'author_id' => 4,
                'title' => 'Hades: Death as Narrative Progression',
                'slug' => 'hades-review',
                'content' => '<div>The structural insight at the heart of Hades is that failure should advance the story rather than interrupt it. Every death returns the player to the starting point, but the world changes in response to each attempt — new dialogue appears, relationships develop, and information accumulates. The rogue-like loop and the narrative are not running in parallel; they are driving each other. The combat is fast and readable, built around a boon system that creates meaningfully different configurations on each run. The God-granted abilities interact in ways that encourage experimentation, and the distinction between a strong build and a weak one is clear enough that improving your decision-making produces a tangible effect on outcomes. The core loop does not overstay its welcome because each run feels like a different version of the same challenge. The writing deserves specific recognition. The script is expansive and consistently sharp, maintaining distinct voices for a large cast of mythological characters. The main narrative thread — a son trying to leave home, a family trying to prevent it — lands with real emotional resonance once the full picture emerges. A landmark achievement in genre design.</div>',
                'summary' => '<div>Hades integrates narrative and rogue-like structure more effectively than anything before it. The combat, writing, and loop design work together to create something exceptional.</div>',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/1145360/capsule_616x353.jpg',
                'game_rating' => 10,
                'status' => 'Deleted',
                'created_at' => '2025-03-08 10:00:00',
                'updated_at' => '2026-04-21 20:12:33',
                'tags' => [
                    3,
                    5,
                    8,
                ],
                'games' => [
                    8,
                ],
            ],
            [
                'id' => 9,
                'author_id' => 5,
                'title' => 'Black Myth: Wukong — A Confident Debut',
                'slug' => 'black-myth-wukong-review',
                'content' => '<div>Black Myth: Wukong announces itself immediately as a game of serious technical ambition. The opening sequences establish a visual quality that places the game in direct comparison with the best-looking titles currently available, and the environmental art design draws on source material that Western and Japanese games have rarely touched. The world has a distinct look that does not feel derivative. The combat system centers on a stance-shifting staff moveset supplemented by transformation abilities that allow the player character to assume the form of defeated enemies. The system has depth without requiring mastery to enjoy, and the boss encounters — which are numerous and inventive — are designed to showcase the full range of what the mechanics can do. Narrative pacing is uneven, and some mid-game sections suffer from a lack of environmental variety that the stronger areas make more apparent by contrast. These are minor reservations about a game that delivers on its core promise impressively. As a first project from a studio with no previous output at this scale, it represents a significant achievement and a strong foundation for future work.</div>',
                'summary' => '<div>Black Myth: Wukong is a technically impressive debut with inventive boss design and a distinctive visual identity rooted in Chinese mythology.</div>',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/2358720/capsule_616x353.jpg',
                'game_rating' => 8,
                'status' => 'Archived',
                'created_at' => '2025-03-13 10:00:00',
                'updated_at' => '2026-04-21 20:12:02',
                'tags' => [
                    2,
                    5,
                    9,
                ],
                'games' => [
                    9,
                ],
            ],
            [
                'id' => 10,
                'author_id' => 5,
                'title' => 'Sekiro: The Case for Precision',
                'slug' => 'sekiro-review',
                'content' => '<div>Sekiro argues, with its entire design, that precision is a more satisfying basis for a combat system than flexibility. Where other action RPGs offer builds and equipment as a buffer between player input and outcomes, Sekiro removes that buffer almost entirely. You succeed when your timing is correct. You fail when it is not. This is either a compelling proposition or an alienating one, depending entirely on what you want from the genre. For players willing to meet the game on its own terms, the posture system is exceptional. Every fight is a structured conversation in which attacking and defending are not cleanly separated — an aggressive offense fills the opponent\'s posture bar and creates the vulnerability that ends the encounter. Learning to read enemy patterns and apply pressure continuously is a genuinely teachable skill, and the moment it clicks in a previously impossible fight is among the most satisfying experiences the medium offers. The setting deserves acknowledgment independent of the mechanical discussion. Late Sengoku Japan, rendered with an attention to architectural and environmental detail that most historical settings lack, gives the game a visual coherence that enhances the atmosphere of its encounters. The final bosses are designed to test everything the game has taught you, and they are worthy of the build-up. Difficult, precise, and worth every attempt.</div>',
                'summary' => '<div>Sekiro builds its entire design around a single commitment to precision, and the result is one of the most satisfying combat systems in any action game.</div>',
                'cover' => 'https://cdn.akamai.steamstatic.com/steam/apps/814380/capsule_616x353.jpg',
                'game_rating' => 9,
                'status' => 'Draft',
                'created_at' => '2025-03-18 10:00:00',
                'updated_at' => '2026-04-21 20:11:26',
                'tags' => [
                    2,
                    5,
                    6,
                ],
                'games' => [
                    10,
                ],
            ],
            [
                'id' => 11,
                'author_id' => 3,
                'title' => 'Cyberpunk 2077 finally feels like the game it wanted to be',
                'slug' => 'cyberpunk-2077-finally-feels-like-the-game-it-wanted-to-be',
                'content' => '<div>Cyberpunk 2077 is at its best when it focuses on Night City and the people trying to survive inside it. The city feels huge, dirty, stylish, and hostile, but also strangely believable. It is not just a background for missions; it gives the whole game its identity. The main story works because V’s problem is personal and urgent, while Johnny Silverhand adds constant tension and conflict. Some side quests are even stronger than the main plot, especially when they show the cost of ambition, violence, and corporate power. Combat and character builds give enough freedom to play as a hacker, shooter, stealth character, or hybrid. The game still has some uneven moments, but its best parts are impressive. Cyberpunk 2077 is not perfect, but it is one of the most memorable modern RPGs.<br><br></div>',
                'summary' => '<div>Cyberpunk 2077 is an ambitious open-world RPG with a dense city, strong characters, and memorable quests. After major updates, its world feels much more coherent, polished, and worth exploring.</div>',
                'cover' => '86dc36de220fc41c614646e22c4d60e347e1f111.jpg',
                'game_rating' => 8,
                'status' => 'Published',
                'created_at' => '2026-04-21 20:56:15',
                'updated_at' => '2026-04-21 20:56:15',
                'tags' => [
                    7,
                ],
                'games' => [],
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $review = (new Review())
                ->setTitle($row['title'])
                ->setSlug($row['slug'])
                ->setAuthor($row['author_id'] ? $this->getReference('user_' . $row['author_id'], User::class) : null)
                ->setContent($row['content'])
                ->setSummary($row['summary'])
                ->setCover($row['cover'])
                ->setGameRating((int) $row['game_rating'])
                ->setStatus(StatusEnum::from($row['status']));

            foreach ($row['tags'] as $tagId) {
                $review->addTag($this->getReference('tag_' . $tagId, Tag::class));
            }

            foreach ($row['games'] as $gameId) {
                $review->addGame($this->getReference('game_' . $gameId, Game::class));
            }

            $this->setEntityTimestamps(
                $review,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($review);
            $this->addReference('review_' . $row['id'], $review);
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