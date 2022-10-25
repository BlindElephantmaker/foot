<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Service;

use App\User\Domain\Entity\User;
use App\User\Domain\Service\UserPasswordHasherInterface;

final class UserPasswordHasher implements UserPasswordHasherInterface
{
    public function __construct(
        private readonly \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface $passwordHasher,
    ) {}

    public function hash(User $user, string $password): string
    {
        return $this->passwordHasher->hashPassword($user, $password);
    }
}
