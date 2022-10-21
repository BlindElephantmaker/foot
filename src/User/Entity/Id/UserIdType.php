<?php

declare(strict_types=1);

namespace App\User\Entity\Id;

use App\Shared\ValueObject\Uuid\UuidIsInvalidException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

final class UserIdType extends GuidType
{
    public const NAME = self::class;

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof UserId ? $value->getValue() : $value;
    }

    /**
     * @throws UuidIsInvalidException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?UserId
    {
        return !empty($value) ? UserId::fromString($value) : null;
    }
}
