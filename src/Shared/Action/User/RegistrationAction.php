<?php

declare(strict_types=1);

namespace App\Shared\Action\User;

use App\Shared\Http\HttpMethod;
use App\Shared\Http\JsonResponse;
use App\Shared\Messenger\Command\CommandBus;
use App\User\Command\Registration\RegistrationCommand;
use App\User\Entity\Email\Email;
use App\User\Entity\Email\EmailIsInvalidException;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

#[Route(path: '/api/user/registration', methods: [HttpMethod::POST])]
final class RegistrationAction
{
    public function __construct(
        private CommandBus $commandBus,
        private NormalizerInterface $normalizer,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $command = $this->decodeRequest($request);
            $response = $this->commandBus->dispatch($command);
        } catch (Exception $e) {
            // todo how handle exceptions from bus? Exceptions: EmailIsInvalidException and UserAlreadyExistException
            dd($e);
        }

        return new JsonResponse(
            $this->normalizer->normalize($response, 'json'),
        );
    }

    /**
     * todo: how move this method to middleware and stop write code for this
     * @throws EmailIsInvalidException
     */
    private function decodeRequest(Request $request): RegistrationCommand
    {
        $decoded = json_decode($request->getContent(), true);
        $email = new Email($decoded['email']);

        $plaintextPassword = $decoded['password'];

        return new RegistrationCommand($email, $plaintextPassword);
    }
}
