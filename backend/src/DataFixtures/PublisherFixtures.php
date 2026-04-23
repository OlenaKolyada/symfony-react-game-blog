<?php

namespace App\DataFixtures;

use App\Entity\Publisher;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PublisherFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = [
            [
                'id' => 1,
                'title' => 'CD Projekt',
                'slug' => 'cd-projekt',
                'country' => 'Poland',
                'website' => 'https://cdprojekt.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'title' => 'Bandai Namco Entertainment',
                'slug' => 'bandai-namco',
                'country' => 'Japan',
                'website' => 'https://www.bandainamcoent.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'title' => 'Rockstar Games',
                'slug' => 'rockstar-games-pub',
                'country' => 'USA',
                'website' => 'https://www.rockstargames.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 4,
                'title' => 'Sony Interactive Entertainment',
                'slug' => 'sony-interactive',
                'country' => 'USA',
                'website' => 'https://www.sie.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 5,
                'title' => 'Larian Studios',
                'slug' => 'larian-studios-pub',
                'country' => 'Belgium',
                'website' => 'https://larian.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 6,
                'title' => 'Team Cherry',
                'slug' => 'team-cherry-pub',
                'country' => 'Australia',
                'website' => 'https://www.teamcherry.com.au',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 7,
                'title' => 'Supergiant Games',
                'slug' => 'supergiant-games-pub',
                'country' => 'USA',
                'website' => 'https://www.supergiantgames.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 8,
                'title' => 'Game Science',
                'slug' => 'game-science-pub',
                'country' => 'China',
                'website' => 'https://www.heishouyouxi.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 9,
                'title' => 'Konami Digital Entertainment',
                'slug' => 'konami-digital-entertainment',
                'country' => 'Japan',
                'website' => 'https://www.konami.com',
                'created_at' => '2026-04-21 20:19:30',
                'updated_at' => '2026-04-21 20:19:30',
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $publisher = (new Publisher())
                ->setTitle($row['title'])
                ->setSlug($row['slug'])
                ->setCountry($row['country'])
                ->setWebsite($row['website']);

            $this->setEntityTimestamps(
                $publisher,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($publisher);
            $this->addReference('publisher_' . $row['id'], $publisher);
        }

        $manager->flush();
    }
}