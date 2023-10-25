<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtTrait;
use App\Entity\Base\IdTrait;
use App\Entity\Base\UpdatedAtTrait;
use App\Repository\ResponseRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResponseRepository::class)]
class Response
{
    use IdTrait, CreatedAtTrait, UpdatedAtTrait;

    #[ORM\Column(length: 255)]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $link = null;

    #[ORM\Column]
    private ?int $connection_id = null;

    public function __construct()
    {
        $dateTime = new DateTimeImmutable();
        $this->created_at = $dateTime;
        $this->updated_at = $dateTime;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getConnectionId(): ?int
    {
        return $this->connection_id;
    }

    public function setConnectionId(int $connection_id): self
    {
        $this->connection_id = $connection_id;
        return $this;
    }
}
