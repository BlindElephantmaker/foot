<?php

declare(strict_types=1);

namespace App\User\Domain\Command\Registration;

use App\User\Domain\Entity\UserId;

final class RegistrationResponse
{
    public function __construct(
        public readonly UserId $userId
    ) {}
}
