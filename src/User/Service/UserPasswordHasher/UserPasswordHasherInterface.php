<?php

declare(strict_types=1);

namespace App\User\Service\UserPasswordHasher;

use App\User\Entity\User;

interface UserPasswordHasherInterface
{
    public function hash(User $user, string $password): string;
}
