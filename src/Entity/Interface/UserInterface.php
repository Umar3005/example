<?php

namespace App\Entity\Interface;

use App\Entity\Role;
use App\Model\Entity\Interface\BaseEntityInterface;

interface UserInterface extends BaseEntityInterface
{
    const ID_FIELD         = 'id';
    const ROLE_ID_FIELD    = 'role_id';
    const PASSWORD_FIELD   = 'password';
    const USER_NAME_FIELD  = 'user_name';
    const CREATED_AT_FIELD = 'created_at';
    const UPDATED_AT_FIELD = 'updated_at';

    public function getUserName(): ?string;

    public function setUserName(string $user_name): self;

    public function setPassword(string $password): self;

    public function getRole(): ?Role;

    public function setRole(?Role $role): self;
}
