<?php

declare(strict_types=1);

namespace App\User\Command\Registration;

use App\User\Entity\Id\UserId;

final class RegistrationResponse
{
    public function __construct(
        private UserId $userId
    ) {}

    public function getUserId(): UserId
    {
        return $this->userId;
    }
}
