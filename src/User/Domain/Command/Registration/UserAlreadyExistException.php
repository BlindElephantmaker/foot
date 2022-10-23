<?php

declare(strict_types=1);

namespace App\User\Domain\Command\Registration;

use App\Shared\Exception\DomainException;

final class UserAlreadyExistException extends DomainException
{
}
