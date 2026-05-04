<?php

namespace App\DTO;

use App\Entity\UserToken;

readonly class TokenCreationResult
{
    public function __construct(
        private UserToken $userToken,
        private string $rawSessionId
    ) {
    }

    public function getUserToken(): UserToken
    {
        return $this->userToken;
    }

    public function getRawSessionId(): string
    {
        return $this->rawSessionId;
    }
}
