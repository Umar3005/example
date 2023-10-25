<?php

namespace App\Model\Factory;

use App\Entity\Interface\RoleInterface;
use App\Entity\Role;
use App\Model\Factory\Interface\BaseFactoryInterface;

class RoleFactory implements BaseFactoryInterface
{
    public function create(array $data): RoleInterface
    {
        $roleEntity = new Role();

        if (isset($data[RoleInterface::NAME_FIELD])) {
            $roleEntity->setName($data[RoleInterface::NAME_FIELD]);
        }

        return $roleEntity;
    }
}
