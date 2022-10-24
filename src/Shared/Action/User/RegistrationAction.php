<?php

declare(strict_types=1);

namespace App\Shared\Action\User;

use App\Shared\Http\HttpMethod;
use App\Shared\Http\JsonResponse;
use App\Shared\Http\SuccessResponse;
use App\Shared\Messenger\Command\CommandBus;
use App\Shared\Serializer\SerializerFormat;
use App\User\Domain\Command\Registration\RegistrationCommand;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route(path: '/api/user/registration', methods: [HttpMethod::POST])]
final class RegistrationAction
{
    public function __construct(
        private CommandBus $commandBus,
        private NormalizerInterface $normalizer,
    ) {}

    public function __invoke(RegistrationCommand $command): JsonResponse
    {
        return new SuccessResponse(
            $this->normalizer->normalize(
                $this->commandBus->dispatch($command),
                SerializerFormat::JSON,
            ),
        );
    }
}
