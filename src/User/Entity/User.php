<?php

declare(strict_types=1);

namespace App\User\Entity;

use App\Security\AuthUserInterface;
use App\Shared\Database\Helper\Types;
use App\User\Entity\Email\Email;
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

    // todo: Fix it. Change property to value-object Email
    // todo: When creating access token, not called method getUserIdentifier()
    // todo: Object is taken via reflection and don`t use Stringable interface
    #[ORM\Column(type: Types::STRING, unique: true)]
    private string $email;

    #[ORM\Column(type: PasswordType::NAME)]
    private Password $password;

    public function __construct(UserId $id, Email $email)
    {
        $this->id = $id;
        $this->email = $email->getValue();
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getEmail(): Email
    {
        return new Email($this->email);
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
        return $this->email;
    }

    public function getRoles(): array
    {
        return [];
    }

    public function eraseCredentials(): void
    {
    }
}
