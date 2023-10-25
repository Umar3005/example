<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtTrait;
use App\Entity\Base\IdTrait;
use App\Entity\Base\UpdatedAtTrait;
use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use \App\Entity\Interface\UserInterface as AppUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, AppUserInterface
{
    use IdTrait, CreatedAtTrait, UpdatedAtTrait;

    #[ORM\Column(length: 180, unique: true)]
    private string $user_name;

    #[ORM\Column(length: 255)]
    private string $password;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Role $role = null;

    public function __construct()
    {
        $dateTime = new DateTimeImmutable();
        $this->created_at = $dateTime;
        $this->updated_at = $dateTime;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUserIdentifier(): string
    {
       return $this->user_name;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }
}
