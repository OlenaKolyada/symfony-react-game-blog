<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    use EntityHelperTrait;

    private const string DEFAULT_PASSWORD = 'grem-user';

    public function __construct(
        private readonly UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    private const ROWS = [
            [
                'id' => 1,
                'email' => 'brie@gmail.com',
                'roles' => '["ROLE_ADMIN", "ROLE_USER"]',
                'nickname' => 'Brie',
                'twitch_account' => 'http://wiegand.com/',
                'avatar' => 'avatar.jpg',
                'created_at' => '2025-04-01 13:11:14',
                'updated_at' => '2025-04-01 13:11:14',
            ],
            [
                'id' => 2,
                'email' => 'kai@gmail.com',
                'roles' => '["ROLE_USER"]',
                'nickname' => 'Kai',
                'twitch_account' => 'http://mosciski.com/',
                'avatar' => 'avatar.jpg',
                'created_at' => '2025-04-01 13:11:14',
                'updated_at' => '2025-04-01 13:11:14',
            ],
            [
                'id' => 3,
                'email' => 'sapphire@gmail.com',
                'roles' => '["ROLE_USER"]',
                'nickname' => 'Sapphire',
                'twitch_account' => 'http://www.schowalter.net/',
                'avatar' => 'avatar.jpg',
                'created_at' => '2025-04-01 13:11:14',
                'updated_at' => '2025-04-01 13:11:14',
            ],
            [
                'id' => 4,
                'email' => 'muse@gmail.com',
                'roles' => '["ROLE_USER"]',
                'nickname' => 'Muse',
                'twitch_account' => 'http://www.haley.com/rem-totam-doloremque-laudantium-voluptas-ut-sint-est',
                'avatar' => 'avatar.jpg',
                'created_at' => '2025-04-01 13:11:15',
                'updated_at' => '2025-04-01 13:11:15',
            ],
            [
                'id' => 5,
                'email' => 'oneeyed@gmail.com',
                'roles' => '["ROLE_USER"]',
                'nickname' => 'OneEyed',
                'twitch_account' => 'https://fay.com/soluta-minima-eum-dolor-sunt.html',
                'avatar' => 'avatar.jpg',
                'created_at' => '2025-04-01 13:11:15',
                'updated_at' => '2025-04-01 13:11:15',
            ],
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ROWS as $row) {
            $user = (new User())
                ->setNickname($row['nickname'])
                ->setEmail($row['email'])
                ->setRoles(json_decode($row['roles'], true, 512, JSON_THROW_ON_ERROR))
                ->setPassword($this->userPasswordHasher->hashPassword($user, self::DEFAULT_PASSWORD))
                ->setTwitchAccount($row['twitch_account'])
                ->setAvatar($row['avatar']);

            $this->setEntityTimestamps(
                $user,
                new \DateTimeImmutable($row['created_at']),
                new \DateTimeImmutable($row['updated_at'])
            );

            $manager->persist($user);
            $this->addReference('user_' . $row['id'], $user);
        }

        $manager->flush();
    }
}
