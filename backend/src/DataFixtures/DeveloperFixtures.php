<?php

namespace App\DataFixtures;

use App\Entity\Developer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DeveloperFixtures extends Fixture
{
    use EntityHelperTrait;

    private const ROWS = [
            [
                'id' => 1,
                'title' => 'CD Projekt Red',
                'slug' => 'cd-projekt-red',
                'country' => 'Poland',
                'website' => 'https://cdprojektred.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 2,
                'title' => 'FromSoftware',
                'slug' => 'fromsoftware',
                'country' => 'Japan',
                'website' => 'https://www.fromsoftware.jp',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 3,
                'title' => 'Rockstar Games',
                'slug' => 'rockstar-games',
                'country' => 'USA',
                'website' => 'https://www.rockstargames.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 4,
                'title' => 'Santa Monica Studio',
                'slug' => 'santa-monica-studio',
                'country' => 'USA',
                'website' => 'https://sms.playstation.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 5,
                'title' => 'Larian Studios',
                'slug' => 'larian-studios',
                'country' => 'Belgium',
                'website' => 'https://larian.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 6,
                'title' => 'Naughty Dog',
                'slug' => 'naughty-dog',
                'country' => 'USA',
                'website' => 'https://www.naughtydog.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 7,
                'title' => 'Team Cherry',
                'slug' => 'team-cherry',
                'country' => 'Australia',
                'website' => 'https://www.teamcherry.com.au',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 8,
                'title' => 'Supergiant Games',
                'slug' => 'supergiant-games',
                'country' => 'USA',
                'website' => 'https://www.supergiantgames.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 9,
                'title' => 'Game Science',
                'slug' => 'game-science',
                'country' => 'China',
                'website' => 'https://www.heishouyouxi.com',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 10,
                'title' => 'Insomniac Games',
                'slug' => 'insomniac-games',
                'country' => 'USA',
                'website' => 'https://insomniac.games',
                'created_at' => '2025-01-01 00:00:00',
                'updated_at' => '2025-01-01 00:00:00',
            ],
            [
                'id' => 11,
                'title' => 'NeoBards Entertainment',
                'slug' => 'neobards-entertainment',
                'country' => 'Hong Kong',
                'website' => 'https://neobards.com/',
                'created_at' => '2026-04-21 20:18:24',
                'updated_at' => '2026-04-21 20:18:24',
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $developer = (new Developer())
                ->setTitle($row['title'])
                ->setSlug($row['slug'])
                ->setCountry($row['country'])
                ->setWebsite($row['website']);

            $this->setEntityTimestamps(
                $developer,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($developer);
            $this->addReference('developer_' . $row['id'], $developer);
        }

        $manager->flush();
    }
}