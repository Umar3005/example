<?php

namespace App\Entity;

use App\Entity\Base\IdTrait;
use App\Entity\Base\CreatedAtTrait;
use App\Repository\ApiLoggerRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApiLoggerRepository::class)]
class ApiLogger
{
    use IdTrait, CreatedAtTrait;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $user_token = null;

    #[ORM\Column(type: Types::STRING)]
    private ?string $action = null;

    public function __construct()
    {
        $dateTime = new DateTimeImmutable();
        $this->created_at = $dateTime;
    }

    public function getUserToken(): ?string
    {
        return $this->user_token;
    }

    public function setUserToken(string $user_token): self
    {
        $this->user_token = $user_token;
        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }
}
