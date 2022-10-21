<?php

declare(strict_types=1);

namespace App\User\Command\Registration;

use App\Shared\Messenger\Command\CommandInterface;
use App\User\Entity\Email\Email;

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
