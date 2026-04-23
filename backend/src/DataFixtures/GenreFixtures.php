<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = [
            [
                'id' => 1,
                'title' => 'RPG',
                'slug' => 'rpg',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'title' => 'Action',
                'slug' => 'action',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'title' => 'Adventure',
                'slug' => 'adventure',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 4,
                'title' => 'Open World',
                'slug' => 'open-world',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 5,
                'title' => 'Souls-like',
                'slug' => 'souls-like',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 6,
                'title' => 'Strategy',
                'slug' => 'strategy',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 7,
                'title' => 'Platformer',
                'slug' => 'platformer',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 8,
                'title' => 'Shooter',
                'slug' => 'shooter',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 9,
                'title' => 'Horror',
                'slug' => 'horror',
                'created_at' => '2026-04-21 20:35:08',
                'updated_at' => '2026-04-21 20:35:08',
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $genre = (new Genre())
                ->setTitle($row['title'])
                ->setSlug($row['slug']);

            $this->setEntityTimestamps(
                $genre,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($genre);
            $this->addReference('genre_' . $row['id'], $genre);
        }

        $manager->flush();
    }
}