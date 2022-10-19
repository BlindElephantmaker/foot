<?php

declare(strict_types=1);

namespace App\Shared\Action\User;

use App\Shared\Helper\Http\Http;
use App\Shared\Service\Flusher;
use App\User\Entity\Email\Email;
use App\User\Entity\Email\EmailIsInvalidException;
use App\User\Entity\Id\UserId;
use App\User\Entity\Password\Password;
use App\User\Entity\User;
use App\User\Exception\UserNotFoundException;
use App\User\Service\UserPasswordHasher\UserPasswordHasherInterface;
use App\User\UserRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api/user/registration', methods: [Http::METHOD_POST])]
final class RegistrationAction
{
    public function __construct(
        private UserRepository $userRepository,
        private Flusher $flusher,
        private UserPasswordHasherInterface $passwordHasher,
    ) {}

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $this->handle(...$this->decodeRequest($request));
        } catch (EmailIsInvalidException) {
            return new JsonResponse('Email is invalid format', 400);
        } catch (Exception $e) { // todo: typed
            return new JsonResponse('User already exist', 400);
        }

        return new JsonResponse('ok');
    }

    /**
     * @throws EmailIsInvalidException
     */
    private function decodeRequest(Request $request): array
    {
        $decoded = json_decode($request->getContent(), true);
        $email = new Email($decoded['email']);

        $plaintextPassword = $decoded['password'];

        return [$email, $plaintextPassword]; // todo: change to Command-DTO
    }

    /**
     * @throws Exception
     */
    private function handle(Email $email, string $password)
    {
        if ($this->isUserExist($email)) {
            throw new Exception(); // todo UserAlreadyExistException
        }

        $user = new User(UserId::next(), $email);
        $user->setPassword(Password::hash($password, $user, $this->passwordHasher));

        $this->userRepository->add($user);
        $this->flusher->flush();
    }

    private function isUserExist(Email $email): bool
    {
        try {
            $this->userRepository->getByEmail($email);
        } catch (UserNotFoundException) {
            return false;
        }

        return true;
    }
}
