<?php

declare(strict_types=1);

namespace App\User\Command\Registration;

use App\User\Exception\UserException;

final class UserAlreadyExistException extends UserException
{
}
