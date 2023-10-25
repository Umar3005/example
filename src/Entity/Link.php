<?php

namespace App\Entity;

use App\Entity\Base\IdTrait;
use App\Entity\Base\CreatedAtTrait;
use App\Repository\LinkRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkRepository::class)]
#[ORM\UniqueConstraint(name: 'link_unique', columns: ['domain', 'short_url'])]
class Link
{
    use IdTrait, CreatedAtTrait;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $user = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $original_url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $domain = null;

    #[ORM\Column(length: 255)]
    private ?string $short_url = null;

    public function __construct()
    {
        $dateTime = new DateTimeImmutable();
        $this->created_at = $dateTime;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getOriginalUrl(): ?string
    {
        return $this->original_url;
    }

    public function setOriginalUrl(?string $original_url): self
    {
        $this->original_url = $original_url;
        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    public function getShortUrl(): ?string
    {
        return $this->short_url;
    }

    public function setShortUrl(string $short_url): self
    {
        $this->short_url = $short_url;
        return $this;
    }
}
