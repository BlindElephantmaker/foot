<?php

declare(strict_types=1);

namespace App\User\Entity\Phone;

use Webmozart\Assert\Assert;
use Webmozart\Assert\InvalidArgumentException;

final class Phone
{
    private const pattern = '%^\+\d{11}$%'; // todo: phone number is not always 11 digits

    private string $value;

    /**
     * @throws PhoneIsInvalidException
     */
    public function __construct(string $value) {
        try {
            Assert::regex($value, self::pattern, PhoneIsInvalidException::class);
        } catch (InvalidArgumentException) {
            throw new PhoneIsInvalidException();
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
