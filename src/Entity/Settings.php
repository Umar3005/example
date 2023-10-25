<?php

namespace App\Entity;

use App\Entity\Base\CreatedAtTrait;
use App\Entity\Base\IdTrait;
use App\Entity\Interface\SettingsInterface;
use App\Repository\SettingsRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SettingsRepository::class)]
#[ORM\UniqueConstraint(name: 'domain_unique', columns: ['connection_id', 'domain', 'protocol'])]
class Settings implements SettingsInterface
{
    use IdTrait, CreatedAtTrait;

    #[ORM\Column]
    private ?int $connection_id = null;

    #[ORM\Column(length: 255)]
    private ?string $domain = null;

    #[ORM\Column(nullable: true)]
    private ?bool $check_url = null;

    #[ORM\Column(length: 255)]
    private ?string $protocol = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $send_response_with_timeout = false;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $response_delay_time = 0;

    public function __construct()
    {
        $dateTime = new DateTimeImmutable();
        $this->created_at = $dateTime;
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

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;
        return $this;
    }

    public function getCheckUrl(): ?bool
    {
        return $this->check_url;
    }

    public function setCheckUrl(bool $check_url): self
    {
        $this->check_url = $check_url;
        return $this;
    }

    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    public function setProtocol(string $protocol): self
    {
        $this->protocol = $protocol;
        return $this;
    }

    public function isSendResponseWithTimeout(): ?bool
    {
        return $this->send_response_with_timeout;
    }

    public function setSendResponseWithTimeout(bool $send_response_with_timeout): self
    {
        $this->send_response_with_timeout = $send_response_with_timeout;
        return $this;
    }

    public function getResponseDelayTime(): ?int
    {
        return $this->response_delay_time;
    }

    public function setResponseDelayTime(int $response_delay_time): self
    {
        $this->response_delay_time = $response_delay_time;
        return $this;
    }
}
