<?php

namespace App\Entity\Main;

use App\Repository\Main\LinksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinksRepository::class)]
class Links
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $host = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $short_url = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;
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
