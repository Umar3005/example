<?php

namespace App\Model\Handler\Error;

use Symfony\Component\HttpFoundation\Response;

class PhonesErrorHandler
{
    public function handlePhonesError(): array
    {
        return [
            'error' => [
                'code' => Response::HTTP_NOT_ACCEPTABLE,
                'desc' => 'More than 1 phone number given'
            ]
        ];
    }
}
