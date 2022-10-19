<?php

declare(strict_types=1);

namespace App\User\Entity;

use App\User\Entity\Email\Email;
use App\User\Entity\Email\EmailType;
use App\User\Entity\Id\UserId;
use App\User\Entity\Id\UserIdType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
final class User
{
    #[ORM\Id]
    #[ORM\Column(type: UserIdType::NAME, unique: true)]
    private UserId $id;

    #[ORM\Column(type: EmailType::NAME, unique: true)]
    private Email $email;

    public function __construct(UserId $id, Email $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }
}
