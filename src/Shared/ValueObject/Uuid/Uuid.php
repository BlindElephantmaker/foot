<?php

declare(strict_types=1);

namespace App\Shared\ValueObject\Uuid;

use Stringable;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

class Uuid implements Stringable
{
    private string $value;

    public static function next(): static
    {
        $value = SymfonyUuid::v4()->toRfc4122();

        return new static($value);
    }

    /**
     * @throws UuidIsInvalidException
     */
    public static function fromString(string $value): static
    {
        if (!SymfonyUuid::isValid($value)) {
            throw new UuidIsInvalidException();
        }

        return new static($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
