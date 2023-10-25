<?php

namespace App\Model\Service\Interface;

use App\Entity\Platform\TurnConnectIn;

interface ResponseProcessorInterface
{
    const HTTP_OPTIONS = ['verify_peer' => false, 'verify_host' => false];

    const HEADERS = [
        'headers' => [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'charset' => 'utf-8'
        ]
    ];

    const SECRET_DATA_FIELDS = ['uuid', 'phone', 'status'];

    public function sendResponse(array $response, TurnConnectIn $connect): void;
}
