<?php

declare(strict_types=1);

namespace App\Shared\ValueObject;

use Stringable;

abstract class ValueObjectString implements Stringable
{
    public function __construct(private string $value)
    {
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
