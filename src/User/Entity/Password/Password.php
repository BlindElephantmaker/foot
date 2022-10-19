<?php

declare(strict_types=1);

namespace App\User\Entity\Password;

use App\Shared\ValueObject\ValueObjectString;
use App\User\Entity\User;
use App\User\Service\UserPasswordHasher\UserPasswordHasherInterface;

final class Password extends ValueObjectString
{
    static public function hash(string $plainPassword, User $user, UserPasswordHasherInterface $passwordHasher): Password
    {
        $hashedPassword = $passwordHasher->hash($user, $plainPassword);
        return new self($hashedPassword);
    }

    static public function fromString(string $hashedPassword): Password
    {
        return new self($hashedPassword);
    }

    private function __construct($hashedPassword)
    {
        parent::__construct($hashedPassword);
    }
}
