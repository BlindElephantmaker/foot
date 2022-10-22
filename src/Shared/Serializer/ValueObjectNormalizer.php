<?php

declare(strict_types=1);

namespace App\Shared\Serializer;

use App\Shared\ValueObject\ValueObject;
use ArrayObject;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ValueObjectNormalizer implements NormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function normalize(mixed $object, string $format = null, array $context = []): float|int|bool|ArrayObject|array|string|null
    {
        return $object->getValue();
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return \is_object($data) && $data instanceof ValueObject;
    }
}
