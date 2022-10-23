<?php

declare(strict_types=1);

namespace App\User\Domain\Entity;

use App\Security\AuthUserInterface;
use App\User\Infrastructure\Entity\EmailType;
use App\User\Infrastructure\Entity\PasswordType;
use App\User\Infrastructure\Entity\UserIdType;
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
