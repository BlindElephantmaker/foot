<?php

declare(strict_types=1);

namespace App\User\Entity\Email;

use App\Shared\ValueObject\ValueObjectString;
use Webmozart\Assert\Assert;
use Webmozart\Assert\InvalidArgumentException;

final class Email extends ValueObjectString
{
    /**
     * @throws EmailIsInvalidException
     */
    public function __construct(string $value)
    {
        try {
            Assert::email($value);
        } catch (InvalidArgumentException) {
            throw new EmailIsInvalidException();
        }

        parent::__construct($value);
    }
}
