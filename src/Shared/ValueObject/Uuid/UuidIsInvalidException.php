<?php

declare(strict_types=1);

namespace App\Shared\ValueObject\Uuid;

use App\Shared\Exception\ValidationException;

final class UuidIsInvalidException extends ValidationException
{
}
