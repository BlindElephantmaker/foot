<?php

declare(strict_types=1);

namespace App\User;

use App\User\Entity\Email\Email;
use App\User\Entity\Id\UserId;
use App\User\Entity\User;
use App\User\Exception\UserNotFoundException;

interface UserRepository
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
