<?php

declare(strict_types=1);

namespace App\Shared\ValueObject\Uuid;

use App\Shared\ValueObject\ValueObjectString;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

class Uuid extends ValueObjectString
{
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

    private function __construct(string $value)
    {
        parent::__construct($value);
    }
}
