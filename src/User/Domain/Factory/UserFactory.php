<?php

declare(strict_types=1);

namespace App\User\Domain\Factory;

use App\User\Domain\Entity\Email;
use App\User\Domain\Entity\Password;
use App\User\Domain\Entity\UserId;
use App\User\Domain\Entity\User;
use App\User\Domain\Service\UserPasswordHasherInterface;

final class UserFactory
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    ) {}

    public function make(Email $email, string $password): User
    {
        $user = new User(UserId::next(), $email);
        $user->setPassword(Password::hash($password, $user, $this->passwordHasher));

        return $user;
    }
}
