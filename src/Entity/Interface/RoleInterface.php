<?php

namespace App\Entity\Interface;

use App\Model\Entity\Interface\BaseEntityInterface;

interface RoleInterface extends BaseEntityInterface
{
    const ID_FIELD   = 'id';
    const NAME_FIELD = 'name';

    const DEFAULT_ROLE = 'ROLE_USER';

    public function getName(): ?string;

    public function setName(string $name): self;
}
