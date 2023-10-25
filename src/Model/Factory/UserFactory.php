<?php

namespace App\Model\Factory;

use App\Entity\Interface\UserInterface;
use App\Entity\User;
use App\Model\Factory\Interface\BaseFactoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory implements BaseFactoryInterface
{
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function create(array $data): UserInterface
    {
        $userEntity = new User();

        if (isset($data[UserInterface::ROLE_ID_FIELD])) {
            $userEntity->setRole($data[UserInterface::ROLE_ID_FIELD]);
        }

        if (isset($data[UserInterface::PASSWORD_FIELD])) {
            $userEntity->setPassword(
                $this->passwordEncoder->hashPassword($userEntity, $data[UserInterface::PASSWORD_FIELD])
            );
        }

        if (isset($data[UserInterface::USER_NAME_FIELD])) {
            $userEntity->setUserName($data[UserInterface::USER_NAME_FIELD]);
        }

        if (isset($data[UserInterface::CREATED_AT_FIELD])) {
            $userEntity->setCreatedAt($data[UserInterface::CREATED_AT_FIELD]);
        }

        if (isset($data[UserInterface::UPDATED_AT_FIELD])) {
            var_dump(4);
            $userEntity->setUpdatedAt($data[UserInterface::UPDATED_AT_FIELD]);
        }

        return $userEntity;
    }
}
