<?php

namespace App\Service;

use App\DTO\TokenCreationResult;
use App\Entity\User;
use App\Entity\UserToken;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Uid\Uuid;
use App\Repository\UserTokenRepository;

readonly class TokenManager
{
    public function __construct(
        private EntityManagerInterface   $entityManager,
        private JWTTokenManagerInterface $jwtManager
    ) {}

    public function createToken(User $user): TokenCreationResult
    {
        $jwtToken = $this->jwtManager->create($user);

        $sessionId = Uuid::v4()->toRfc4122();

        $userToken = new UserToken();
        $userToken->setUser($user);
        $userToken->setToken($jwtToken);
        $userToken->setSessionId($this->hashSessionId($sessionId));
        $userToken->setExpiresAt(new \DateTime('+1 day'));
        $userToken->setRevoked(false);

        $this->entityManager->persist($userToken);
        $this->entityManager->flush();

        return new TokenCreationResult($userToken, $sessionId);
    }

    public function validateToken(string $sessionId): ?UserToken
    {
        /** @var UserTokenRepository $repository */
        $repository = $this->entityManager->getRepository(UserToken::class);
        return $repository->findActiveToken($this->hashSessionId($sessionId));
    }

    public function revokeToken(string $sessionId): bool
    {
        $userToken = $this->entityManager->getRepository(UserToken::class)
            ->findOneBy(['sessionId' => $this->hashSessionId($sessionId)]);

        if (!$userToken) {
            return false;
        }

        $userToken->setRevoked(true);
        $this->entityManager->flush();

        return true;
    }

    public function revokeAllUserTokens(User $user): int
    {
        $userTokens = $this->entityManager->getRepository(UserToken::class)
            ->findBy(['user' => $user, 'isRevoked' => false]);

        $count = 0;
        foreach ($userTokens as $token) {
            $token->setRevoked(true);
            $count++;
        }

        $this->entityManager->flush();

        return $count;
    }

    private function hashSessionId(string $sessionId): string
    {
        return hash('sha256', $sessionId);
    }
}
