<?php

declare(strict_types=1);

namespace App\Shared\ValueObject;

abstract class ValueObjectString implements ValueObject
{
    public function __construct(
        private string $value,
    ) {}

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
