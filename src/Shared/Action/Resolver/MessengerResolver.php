<?php

declare(strict_types=1);

namespace App\Shared\Action\Resolver;

use App\Shared\Messenger\MessageInterface;
use App\Shared\Serializer\SerializerFormat;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class MessengerResolver implements ArgumentValueResolverInterface
{
    public function __construct(
        private DenormalizerInterface $denormalizer,
    ) {}

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return is_subclass_of($argument->getType(), MessageInterface::class);
    }

    /**
     * @throws ExceptionInterface
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $decoded = json_decode($request->getContent(), true);

        yield $this->denormalizer->denormalize($decoded, $argument->getType(), SerializerFormat::JSON);
    }
}
