<?php

declare(strict_types=1);

namespace App\User\Entity\Password;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class PasswordType extends StringType
{
    public const NAME = self::class;

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Password ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?Password
    {
        return !empty($value) ? Password::fromString($value) : null;
    }
}
