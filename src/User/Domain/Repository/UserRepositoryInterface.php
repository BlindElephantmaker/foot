<?php

declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Entity\Email;
use App\User\Domain\Entity\UserId;
use App\User\Domain\Entity\User;
use App\User\Domain\Exception\UserNotFoundException;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    /**
     * @throws UserNotFoundException
     */
    public function get(UserId $userId): User;

    /**
     * @throws UserNotFoundException
     */
    public function getByEmail(Email $email): User;
}
