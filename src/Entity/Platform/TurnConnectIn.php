<?php

namespace App\Entity\Platform;

use App\Repository\Platform\TurnConnectInRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TurnConnectInRepository::class)]
class TurnConnectIn
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    public int $sId;

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private ?int $sUserId = 0;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $sConnectName = '';

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $sSystemId = '';

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $sSystemType = '';

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $sPassword = '';

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $sBindType = '';

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private ?int $sRunPid = 0;

    #[ORM\Column(type: Types::INTEGER, nullable: false, options: ['default' => 1])]
    private ?int $sDisable = 1;

    #[ORM\Column(type: Types::INTEGER, nullable: false, options: ['default' => 5])]
    private ?int $sRespWindow = 5;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => -1])]
    private ?int $sSendSrcton = -1;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => -1])]
    private ?int $sSendSrcnpi = -1;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => -1])]
    private ?int $sSendDstton = -1;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => -1])]
    private ?int $sSendDstnpi = -1;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => -1])]
    private ?int $sRecvSrcton = -1;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => -1])]
    private ?int $sRecvSrcnpi = -1;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => -1])]
    private ?int $sRecvDstton = -1;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => -1])]
    private ?int $sRecvDstnpi = -1;

    #[ORM\Column(type: Types::BIGINT, nullable: false, options: ['default' => 60])]
    private ?int $sSendEnquirelink = 60;

    #[ORM\Column(type: Types::BIGINT, nullable: false, options: ['default' => 0])]
    private ?int $sAnySendEnquirelink = 0;

    #[ORM\Column(type: Types::INTEGER, nullable: false, options: ['default' => 1])]
    private ?int $sDebug = 1;

    #[ORM\Column(type: Types::INTEGER, nullable: false, options: ['default' => 1])]
    private ?int $sDebugDump = 1;

    #[ORM\Column(type: Types::INTEGER, nullable: false, options: ['default' => 0])]
    private ?int $sSmsLimit = 0;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => 3])]
    private ?int $sTypeMessageId = 3;

    #[ORM\Column(type: Types::SMALLINT, nullable: false, options: ['default' => 10])]
    private ?int $maximumConnectCount = 10;

    #[ORM\Column(type: Types::TEXT, nullable: false, options: ['default' => 'smpp'])]
    private ?string $protocol = 'smpp';

    #[ORM\Column(type: Types::TEXT, nullable: false, options: ['default' => ''])]
    private ?string $statusUrl = '';

    #[ORM\Column(type: Types::TEXT, nullable: false, options: ['default' => ''])]
    private ?string $statusSecretKey = '';

    #[ORM\Column(type: Types::INTEGER, nullable: false, options: ['default' => 0])]
    private ?int $allowStatusRequest = 0;

    #[ORM\Column(type: Types::BIGINT, nullable: false, options: ['default' => 0])]
    private ?int $smppExtension = 0;

    public function getStatusUrl(): ?string
    {
        return $this->statusUrl;
    }

    public function getStatusSecretKey(): ?string
    {
        return $this->statusSecretKey;
    }

    public function getLogin(): ?string
    {
        return $this->sSystemId;
    }
}
