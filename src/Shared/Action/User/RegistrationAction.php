<?php

declare(strict_types=1);

namespace App\Shared\Action\User;

use App\Shared\Helper\Http;
use App\Shared\Messenger\Command\CommandBusInterface;
use App\User\Command\Registration\RegistrationCommand;
use App\User\Entity\Email\Email;
use App\User\Entity\Email\EmailIsInvalidException;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/user/registration', methods: [Http::METHOD_POST])]
final class RegistrationAction
{
    public function __construct(
        private CommandBusInterface $commandBus
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $command = $this->decodeRequest($request);
            $userId = $this->commandBus->dispatch($command);
        } catch (Exception $e) {
            // todo how handle exceptions from bus? Exceptions: EmailIsInvalidException and UserAlreadyExistException
            dd($e);
        }

        return new JsonResponse(['user_id' => $userId]);
    }

    /**
     * todo: how change this method to middleware and stop write code for this
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
