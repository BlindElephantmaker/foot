<?php

declare(strict_types=1);

namespace App\Shared\ValueObject;

use Stringable;

interface ValueObject extends Stringable
{
    public function getValue(): mixed;

    /**
     * @inheritDoc
     */
    public function __toString(): string;
}
