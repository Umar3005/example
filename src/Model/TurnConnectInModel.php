<?php

namespace App\Model;

use App\Repository\Platform\TurnConnectInRepository;
use \App\Entity\Platform\TurnConnectIn;

class TurnConnectInModel
{
    private TurnConnectInRepository $connectInRepository;

    public function __construct(TurnConnectInRepository $connectInRepository)
    {
        $this->connectInRepository = $connectInRepository;
    }

    public function getTurnConnectByCredentials(string $login, string $password): ?TurnConnectIn
    {
        return $this->connectInRepository->findOneBy(['sSystemId' => $login, 'sPassword' => $password]);
    }
}
