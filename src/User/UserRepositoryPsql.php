<?php

declare(strict_types=1);

namespace App\User;

use App\User\Entity\Email\Email;
use App\User\Entity\Id\UserId;
use App\User\Entity\User;
use App\User\Exception\UserNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class UserRepositoryPsql implements UserRepository
{
    private EntityRepository $repository;

    public function __construct(
        private EntityManagerInterface $em
    ) {
        $this->repository = $em->getRepository(User::class);
    }

    public function add(User $user): void
    {
        $this->em->persist($user);
    }

    /**
     * @inheritDoc
     */
    public function get(UserId $userId): User
    {
        $user = $this->repository->find($userId);

        return $this->objectOrException($user);
    }

    /**
     * @inheritDoc
     */
    public function getByEmail(Email $email): User
    {
        $user = $this->repository->findOneBy(['email' => $email->getValue()]);

        return $this->objectOrException($user);
    }

    /**
     * @throws UserNotFoundException
     */
    private function objectOrException(?User $user): User
    {
        if (!$user instanceof User) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
