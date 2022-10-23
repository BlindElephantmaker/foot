<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\Shared\ValueObject\ValueObjectString;
use App\User\Domain\Exception\EmailIsInvalidException;
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
