<?php

declare(strict_types=1);

namespace App\User\Domain\Command\Registration;

use App\Shared\Messenger\Command\CommandInterface;
use App\User\Domain\Entity\Email;

final class RegistrationCommand implements CommandInterface
{
    public function __construct(
        private Email $email,
        private string $password,
    ) {}

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
