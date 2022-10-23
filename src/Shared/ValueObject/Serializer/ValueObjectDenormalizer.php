<?php

declare(strict_types=1);

namespace App\Shared\ValueObject\Serializer;

use App\Shared\ValueObject\ValueObject;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class ValueObjectDenormalizer implements DenormalizerInterface
{
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ValueObject
    {
        return new $type($data);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return is_subclass_of($type, ValueObject::class);
    }
}
