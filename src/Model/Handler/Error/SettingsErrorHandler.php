<?php

namespace App\Model\Handler\Error;

use Symfony\Component\HttpFoundation\Response;

class SettingsErrorHandler
{
    public function handleSettingsError(): array
    {
        return [
            'error' => [
                'code' => Response::HTTP_UNAUTHORIZED,
                'desc' => 'No registered domain found for this connection_id '
            ]
        ];
    }

    public function handleCheckUrlError(): array
    {
        return [
            'error' => [
                'code' => Response::HTTP_BAD_REQUEST,
                'desc' => 'No link found'
            ]
        ];
    }
}
