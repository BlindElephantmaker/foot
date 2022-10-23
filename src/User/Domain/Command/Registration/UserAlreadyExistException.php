<?php

declare(strict_types=1);

namespace App\User\Domain\Command\Registration;

use App\User\Domain\Exception\UserException;

final class UserAlreadyExistException extends UserException
{
}
