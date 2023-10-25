<?php

namespace App\Entity\Interface;

use App\Model\Entity\Interface\BaseEntityInterface;

interface SettingsInterface extends BaseEntityInterface
{
    const ID_FIELD                         = 'id';
    const DOMAIN_FIELD                     = 'domain';
    const PROTOCOL_FIELD                   = 'protocol';
    const CHECK_URL_FIELD                  = 'check_url';
    const CREATED_AT_FIELD                 = 'created_at';
    const CONNECTION_ID_FIELD              = 'connection_id';
    const RESPONSE_DELAY_TIME_FIELD        = 'response_delay_time';
    const SEND_RESPONSE_WITH_TIMEOUT_FIELD = 'send_response_with_timeout';

    public function getConnectionId(): ?int;

    public function setConnectionId(int $connection_id): self;

    public function getDomain(): ?string;

    public function setDomain(string $domain): self;

    public function getCheckUrl(): ?bool;

    public function setCheckUrl(bool $check_url): self;

    public function getProtocol(): ?string;

    public function setProtocol(string $protocol): self;

    public function isSendResponseWithTimeout(): ?bool;

    public function setSendResponseWithTimeout(bool $send_response_with_timeout): self;

    public function getResponseDelayTime(): ?int;

    public function setResponseDelayTime(int $response_delay_time): self;
}
