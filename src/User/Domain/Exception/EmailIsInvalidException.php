<?php

declare(strict_types=1);

namespace App\User\Domain\Exception;

use App\Shared\Exception\ValidationException;

final class EmailIsInvalidException extends ValidationException
{
}
