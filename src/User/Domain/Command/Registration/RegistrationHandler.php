<?php

declare(strict_types=1);

namespace App\User\Domain\Command\Registration;

use App\Shared\Messenger\Command\CommandHandlerInterface;
use App\Shared\Service\Flusher;
use App\User\Domain\Entity\Email;
use App\User\Domain\Exception\UserNotFoundException;
use App\User\Domain\Factory\UserFactory;
use App\User\Domain\Repository\UserRepositoryInterface;

final class RegistrationHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserFactory $userFactory,
        private readonly UserRepositoryInterface $userRepository,
        private readonly Flusher $flusher,
    ) {}

    /**
     * @throws UserAlreadyExistException
     */
    public function __invoke(RegistrationCommand $command): RegistrationResponse
    {
        if ($this->isUserExist($command->email)) {
            throw new UserAlreadyExistException();
        }

        $user = $this->userFactory->make($command->email, $command->password);

        $this->userRepository->add($user);
        $this->flusher->flush();

        return new RegistrationResponse($user->getId());
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
