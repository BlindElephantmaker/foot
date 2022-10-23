<?php

declare(strict_types=1);

namespace App\Shared\Exception;

use Throwable;

abstract class Exception extends \Exception
{
    public const NAME = 'common_message';

    public function __construct($message = self::NAME, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
