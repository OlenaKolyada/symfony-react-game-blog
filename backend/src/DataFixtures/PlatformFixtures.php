<?php

namespace App\DataFixtures;

use App\Entity\Platform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlatformFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = [
            [
                'id' => 1,
                'title' => 'PC',
                'slug' => 'pc',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'title' => 'PlayStation 5',
                'slug' => 'playstation-5',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'title' => 'PlayStation 4',
                'slug' => 'playstation-4',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 4,
                'title' => 'Xbox Series X/S',
                'slug' => 'xbox-series',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 5,
                'title' => 'Nintendo Switch',
                'slug' => 'nintendo-switch',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 6,
                'title' => 'Steam',
                'slug' => 'steam',
                'created_at' => '2026-04-21 20:36:00',
                'updated_at' => '2026-04-21 20:36:00',
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $platform = (new Platform())
                ->setTitle($row['title'])
                ->setSlug($row['slug']);

            $this->setEntityTimestamps(
                $platform,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($platform);
            $this->addReference('platform_' . $row['id'], $platform);
        }

        $manager->flush();
    }
}