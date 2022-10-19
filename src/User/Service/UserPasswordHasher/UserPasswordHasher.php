<?php

declare(strict_types=1);

namespace App\User\Service\UserPasswordHasher;

use App\User\Entity\User;

final class UserPasswordHasher implements UserPasswordHasherInterface
{
    public function __construct(
        private \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface $passwordHasher
    ) {}

    public function hash(User $user, string $password): string
    {
        return $this->passwordHasher->hashPassword($user, $password);
    }
}
