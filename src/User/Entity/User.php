<?php

declare(strict_types=1);

namespace App\User\Entity;

use App\Security\AuthUserInterface;
use App\User\Entity\Email\Email;
use App\User\Entity\Email\EmailType;
use App\User\Entity\Id\UserId;
use App\User\Entity\Id\UserIdType;
use App\User\Entity\Password\Password;
use App\User\Entity\Password\PasswordType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
final class User implements AuthUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: UserIdType::NAME, unique: true)]
    private UserId $id;

    #[ORM\Column(type: EmailType::NAME, unique: true)]
    private Email $email;

    #[ORM\Column(type: PasswordType::NAME)]
    private Password $password;

    public function __construct(UserId $id, Email $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getPassword(): string
    {
        return $this->password->getValue();
    }

    public function setPassword(Password $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email->getValue();
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {
    }
}
