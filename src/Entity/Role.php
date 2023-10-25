<?php

namespace App\Entity;

use App\Entity\Base\IdTrait;
use App\Entity\Interface\RoleInterface;
use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role implements RoleInterface
{
    use IdTrait;

    #[ORM\Column(length: 31)]
    private ?string $name = null;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
}
