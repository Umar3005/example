<?php

namespace App\Model\Entity\Interface;

interface SendSmsRequestEntityInterface extends BaseEntityInterface
{
    const LOGIN            = 'login';
    const MESSAGE          = 'message';
    const PASSWORD         = 'password';
    const SHORTEN_URL      = 'shorten_url';
    const VIBER_BUTTON_URL = 'viber_button_url';

    public function setLogin(string $login): self;

    public function getLogin(): ?string;

    public function setMessage(string $message): self;

    public function getMessage(): ?string;

    public function setPassword(string $password): self;

    public function getPassword(): ?string;

    public function setShortenUrl(int $shortenUrl): self;

    public function getShortenUrl(): ?int;

    public function setViberButtonUrl(string $viberButtonUrl): self;

    public function getViberButtonUrl(): ?string;
}
