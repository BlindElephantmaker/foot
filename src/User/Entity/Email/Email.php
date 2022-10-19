<?php

declare(strict_types=1);

namespace App\User\Entity\Email;

use Stringable;
use Webmozart\Assert\Assert;
use Webmozart\Assert\InvalidArgumentException;

final class Email implements Stringable
{
    private string $value;

    public function __construct(string $value)
    {
        try {
            Assert::email($value);
        } catch (InvalidArgumentException) {
            throw new EmailIsInvalidException();
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
