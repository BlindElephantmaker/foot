<?php

declare(strict_types=1);

namespace App\User\Command\Registration;

use App\Shared\Messenger\Command\CommandHandlerInterface;
use App\Shared\Service\Flusher;
use App\User\Entity\Email\Email;
use App\User\Entity\Id\UserId;
use App\User\Exception\UserNotFoundException;
use App\User\Factory\UserFactory;
use App\User\UserRepository;

final class RegistrationHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserFactory $userFactory,
        private UserRepository $userRepository,
        private Flusher $flusher,
    ) {}

    /**
     * @throws UserAlreadyExistException
     */
    public function __invoke(RegistrationCommand $command): UserId
    {
        if ($this->isUserExist($command->getEmail())) {
            throw new UserAlreadyExistException();
        }

        $user = $this->userFactory->make($command->getEmail(), $command->getPassword());

        $this->userRepository->add($user);
        $this->flusher->flush();

        return $user->getId();
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
