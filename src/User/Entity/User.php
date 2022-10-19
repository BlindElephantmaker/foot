<?php

declare(strict_types=1);

namespace App\User\Entity;

use App\User\Entity\Id\UserId;
use App\User\Entity\Id\UserIdType;
use App\User\Entity\Phone\Phone;
use App\User\Entity\Phone\PhoneType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
final class User
{
    #[ORM\Id]
    #[ORM\Column(type: UserIdType::NAME, unique: true)]
    private UserId $id;

    #[ORM\Column(type: PhoneType::NAME, length: 12, unique: true)]
    private Phone $phone;

    public function __construct(UserId $id, Phone $phone)
    {
        $this->id = $id;
        $this->phone = $phone;
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }
}
