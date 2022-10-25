<?php

declare(strict_types=1);

namespace App\User\Domain\Command\Registration;

use App\Shared\Messenger\Command\CommandInterface;
use App\User\Domain\Entity\Email;

final class RegistrationCommand implements CommandInterface
{
    public function __construct(
        public readonly Email $email,
        public readonly string $password,
    ) {}
}
