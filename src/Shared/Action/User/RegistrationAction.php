<?php

declare(strict_types=1);

namespace App\Shared\Action\User;

use App\Shared\Http\HttpMethod;
use App\Shared\Http\JsonResponse;
use App\Shared\Messenger\Command\CommandBus;
use App\User\Domain\Command\Registration\RegistrationCommand;
use Exception;
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
        try {
            $response = $this->commandBus->dispatch($command);
        } catch (Exception $e) {
            // todo how handle exceptions from bus? Exceptions: EmailIsInvalidException and UserAlreadyExistException
            dd($e);
        }

        return new JsonResponse(
            $this->normalizer->normalize($response, 'json'),
        );
    }
}
