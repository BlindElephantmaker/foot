<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Entity;

use App\User\Domain\Entity\Email;
use App\User\Domain\Exception\EmailIsInvalidException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class EmailType extends StringType
{
    public const NAME = self::class;

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): mixed
    {
        return $value instanceof Email ? $value->getValue() : $value;
    }

    /**
     * @throws EmailIsInvalidException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
    {
        return !empty($value) ? new Email($value) : null;
    }
}
