<?php

namespace App\Model\Handler\Error;

use Symfony\Component\HttpFoundation\Response;

class TurnConnectInErrorHandler
{
    public function handleConnectAuthorizationError(): array
    {
        return [
            'error' => [
                'code' => Response::HTTP_FORBIDDEN,
                'desc' => 'Authorization error'
            ]
        ];
    }
}
