<?php

declare(strict_types=1);

namespace App\User\Entity\Phone;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class PhoneType extends StringType
{
    public const NAME = self::class;

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        return $value instanceof Phone ? $value->getValue() : $value;
    }

    /**
     * @throws PhoneIsInvalidException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Phone
    {
        return !empty($value) ? new Phone($value) : null;
    }
}
