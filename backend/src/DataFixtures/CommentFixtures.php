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

    private const ROWS = [
            [
                'id' => 1,
                'author_id' => 2,
                'review_id' => 1,
                'content' => 'The 2.0 overhaul changed the game completely. Build variety is genuinely impressive now and Night City finally feels reactive.',
                'status' => 'Published',
                'created_at' => '2025-02-04 12:00:00',
                'updated_at' => '2025-02-04 12:00:00',
            ],
            [
                'id' => 2,
                'author_id' => 3,
                'review_id' => 1,
                'content' => 'Agree on the story. The ending I got surprised me — did not expect them to take it in that direction. Worth a second run.',
                'status' => 'Published',
                'created_at' => '2025-02-04 14:00:00',
                'updated_at' => '2025-02-04 14:00:00',
            ],
            [
                'id' => 3,
                'author_id' => 4,
                'review_id' => 2,
                'content' => 'The underground map alone is worth the price of entry. Stumbled into it completely by accident and spent three hours there.',
                'status' => 'Published',
                'created_at' => '2025-02-08 10:00:00',
                'updated_at' => '2025-02-08 10:00:00',
            ],
            [
                'id' => 4,
                'author_id' => 5,
                'review_id' => 2,
                'content' => 'The DLC final boss is one of the hardest things I have ever encountered in a game. Took me four days. Do not regret a minute of it.',
                'status' => 'Published',
                'created_at' => '2025-02-08 15:00:00',
                'updated_at' => '2025-02-08 15:00:00',
            ],
            [
                'id' => 5,
                'author_id' => 2,
                'review_id' => 3,
                'content' => 'The Bloody Baron questline genuinely has no equivalent in the medium. Every choice feels real and the consequences follow through properly.',
                'status' => 'Published',
                'created_at' => '2025-02-13 11:00:00',
                'updated_at' => '2025-02-13 11:00:00',
            ],
            [
                'id' => 6,
                'author_id' => 4,
                'review_id' => 3,
                'content' => 'Blood and Wine is better than most full games. The ending of that expansion stayed with me longer than the main story did.',
                'status' => 'Published',
                'created_at' => '2025-02-13 16:00:00',
                'updated_at' => '2025-02-13 16:00:00',
            ],
            [
                'id' => 7,
                'author_id' => 3,
                'review_id' => 4,
                'content' => 'Chapter six is devastating. The writing in that section does things that prestige television rarely manages.',
                'status' => 'Published',
                'created_at' => '2025-02-18 09:00:00',
                'updated_at' => '2025-02-18 09:00:00',
            ],
            [
                'id' => 8,
                'author_id' => 5,
                'review_id' => 4,
                'content' => 'The strangers system is what I keep coming back to. Found a complete story arc across three separate encounters in different parts of the map.',
                'status' => 'Published',
                'created_at' => '2025-02-18 17:00:00',
                'updated_at' => '2025-02-18 17:00:00',
            ],
            [
                'id' => 9,
                'author_id' => 2,
                'review_id' => 5,
                'content' => 'The Atreus sections added more than I expected. His perspective on the events makes the overall story land differently.',
                'status' => 'Published',
                'created_at' => '2025-02-23 10:00:00',
                'updated_at' => '2025-02-23 10:00:00',
            ],
            [
                'id' => 10,
                'author_id' => 4,
                'review_id' => 5,
                'content' => 'The final realm set pieces are the most technically impressive things I have seen in a game this generation. Santa Monica knows what they are doing.',
                'status' => 'Published',
                'created_at' => '2025-02-23 18:00:00',
                'updated_at' => '2025-02-23 18:00:00',
            ],
            [
                'id' => 11,
                'author_id' => 2,
                'review_id' => 6,
                'content' => 'Two hundred hours and I am still encountering dialogue I have not seen. The volume of written content in this game is genuinely staggering.',
                'status' => 'Published',
                'created_at' => '2025-02-28 11:00:00',
                'updated_at' => '2025-02-28 11:00:00',
            ],
            [
                'id' => 12,
                'author_id' => 3,
                'review_id' => 6,
                'content' => 'Co-op is a completely different game. Four people making conflicting choices produces situations the designers clearly did not script. It is brilliant.',
                'status' => 'Published',
                'created_at' => '2025-02-28 19:00:00',
                'updated_at' => '2025-02-28 19:00:00',
            ],
            [
                'id' => 13,
                'author_id' => 4,
                'review_id' => 7,
                'content' => 'The boss design in this game is exceptional throughout. Each one introduces a mechanic it expects you to master before it escalates.',
                'status' => 'Published',
                'created_at' => '2025-03-04 10:00:00',
                'updated_at' => '2025-03-04 10:00:00',
            ],
            [
                'id' => 14,
                'author_id' => 5,
                'review_id' => 7,
                'content' => 'Three developers built this entire world. The scale of the achievement relative to the team size is almost impossible to explain to someone who has not played it.',
                'status' => 'Published',
                'created_at' => '2025-03-04 16:00:00',
                'updated_at' => '2025-03-04 16:00:00',
            ],
            [
                'id' => 15,
                'author_id' => 2,
                'review_id' => 8,
                'content' => 'The point where the full narrative picture assembled itself was one of the most affecting moments I have had in a game in years.',
                'status' => 'Published',
                'created_at' => '2025-03-09 11:00:00',
                'updated_at' => '2025-03-09 11:00:00',
            ],
            [
                'id' => 16,
                'author_id' => 3,
                'review_id' => 8,
                'content' => 'Every rogue-like I play now gets measured against this. Most of them fail the comparison.',
                'status' => 'Published',
                'created_at' => '2025-03-09 20:00:00',
                'updated_at' => '2025-03-09 20:00:00',
            ],
            [
                'id' => 17,
                'author_id' => 4,
                'review_id' => 9,
                'content' => 'Some of the boss arenas in chapter three are the most visually inventive I have encountered. The source material clearly gave the designers a lot to work with.',
                'status' => 'Published',
                'created_at' => '2025-03-14 12:00:00',
                'updated_at' => '2025-03-14 12:00:00',
            ],
            [
                'id' => 18,
                'author_id' => 5,
                'review_id' => 9,
                'content' => 'A remarkable first project at this scale. Whatever they build next will be very interesting to watch.',
                'status' => 'Published',
                'created_at' => '2025-03-14 18:00:00',
                'updated_at' => '2025-03-14 18:00:00',
            ],
            [
                'id' => 19,
                'author_id' => 2,
                'review_id' => 10,
                'content' => 'The final sequence tests everything the game taught you over sixty hours and does it fairly. That is harder to design than it sounds.',
                'status' => 'Published',
                'created_at' => '2025-03-19 10:00:00',
                'updated_at' => '2025-03-19 10:00:00',
            ],
            [
                'id' => 20,
                'author_id' => 3,
                'review_id' => 10,
                'content' => 'The moment the parry rhythm clicked was the most satisfying mechanical revelation I have experienced in any action game.',
                'status' => 'Published',
                'created_at' => '2025-03-19 17:00:00',
                'updated_at' => '2025-03-19 17:00:00',
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $comment = (new Comment())
                ->setContent($row['content'])
                ->setStatus(CommentStatusEnum::from($row['status']))
                ->setAuthor($row['author_id'] ? $this->getReference('user_' . $row['author_id'], User::class) : null)
                ->setReview($this->getReference('review_' . $row['review_id'], Review::class));

            $this->setEntityTimestamps(
                $comment,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($comment);
            $this->addReference('comment_' . $row['id'], $comment);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ReviewFixtures::class,
            UserFixtures::class,
        ];
    }
}