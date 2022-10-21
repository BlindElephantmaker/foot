<?php

declare(strict_types=1);

namespace App\User\Factory;

use App\User\Entity\Email\Email;
use App\User\Entity\Id\UserId;
use App\User\Entity\Password\Password;
use App\User\Entity\User;
use App\User\Service\UserPasswordHasher\UserPasswordHasherInterface;

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
