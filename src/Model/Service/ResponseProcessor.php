<?php

namespace App\Model\Service;

use App\Entity\Platform\TurnConnectIn;
use App\Model\Service\Interface\ResponseProcessorInterface;
use DateTime;
use Exception;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ResponseProcessor implements ResponseProcessorInterface
{
    /** @throws Exception | TransportExceptionInterface */
    public function sendResponse(array $response, TurnConnectIn $connect): void
    {
        if (!$connect->getStatusUrl()) {
            return;
        }

        $http = HttpClient::create(self::HTTP_OPTIONS);
        $http->request(
            'POST',
            $connect->getStatusUrl(),
            array_merge(self::HEADERS, $this->getBody($response, $connect))
        );
    }


    private function getSecretString(array $response): string
    {
        $result = '';
        foreach (self::SECRET_DATA_FIELDS as $field) {
            $result = $result . ':' . $response[$field];
        }

        return $result;
    }

    /** @throws Exception */
    private function getBody(array $response, TurnConnectIn $connect): array
    {
        $datetime = new DateTime($response['updated_at']);

        return [
            'body' => [
                'id' => $response['uuid'],
                'phone' => $response['phone'],
                'status' => '4', //$response->getStatus(),
                'time' => $datetime->format('d.m.y H:i:s'),
                'ts' => $datetime->getTimestamp(),
                'md5' => md5($this->getSecretString($response) . ':' . $connect->getStatusSecretKey()),
                'charset' => 'utf-8',
                'service' => 'easysms',
                'login' => $connect->getLogin(),
            ]
        ];
    }
}
