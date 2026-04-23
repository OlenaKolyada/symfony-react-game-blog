<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = [
            [
                'id' => 1,
                'title' => 'Open World',
                'slug' => 'open-world',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'title' => 'Souls-like',
                'slug' => 'souls-like',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'title' => 'Story Rich',
                'slug' => 'story-rich',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 4,
                'title' => 'Multiplayer',
                'slug' => 'multiplayer',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 5,
                'title' => 'Single Player',
                'slug' => 'single-player',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 6,
                'title' => 'Dark Fantasy',
                'slug' => 'dark-fantasy',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 7,
                'title' => 'Cyberpunk',
                'slug' => 'cyberpunk',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 8,
                'title' => 'Indie',
                'slug' => 'indie',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 9,
                'title' => 'Action RPG',
                'slug' => 'action-rpg',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 10,
                'title' => 'Noir',
                'slug' => 'noir',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $tag = (new Tag())
                ->setTitle($row['title'])
                ->setSlug($row['slug']);

            $this->setEntityTimestamps(
                $tag,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($tag);
            $this->addReference('tag_' . $row['id'], $tag);
        }

        $manager->flush();
    }
}