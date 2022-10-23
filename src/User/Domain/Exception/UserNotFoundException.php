<?php

declare(strict_types=1);

namespace App\User\Domain\Exception;

use App\Shared\Exception\DomainException;

final class UserNotFoundException extends DomainException
{
    public const NAME = 'user_not_found';
}
