<?php

namespace App\Model\Entity;

use App\Model\Entity\Interface\SendSmsRequestEntityInterface;

class SendSmsRequestEntity implements SendSmsRequestEntityInterface
{
    private ?string $login;

    private ?string $password;

    private ?string $message;

    private ?int $shortenUrl;

    private ?string $viberButtonUrl;

    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setShortenUrl(int $shortenUrl): self
    {
        $this->shortenUrl = $shortenUrl;
        return $this;
    }

    public function getShortenUrl(): ?int
    {
        return $this->shortenUrl;
    }

    public function setViberButtonUrl(string $viberButtonUrl): self
    {
        $this->viberButtonUrl = $viberButtonUrl;
        return $this;
    }

    public function getViberButtonUrl(): ?string
    {
        return $this->viberButtonUrl;
    }
}
