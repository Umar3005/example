<?php

namespace App\Model\Factory\Interface;

use App\Model\Entity\Interface\BaseEntityInterface;

interface BaseFactoryInterface
{
    public function create(array $data): BaseEntityInterface;
}
