<?php

namespace App\Controller;

use App\Model\Command\SendSmsCommand;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class RestController extends AbstractController
{
    private SendSmsCommand $sendSmsCommand;

    public function __construct(SendSmsCommand $sendSmsCommand)
    {
        $this->sendSmsCommand = $sendSmsCommand;
    }

    /** @throws ServerExceptionInterface | RedirectionExceptionInterface | ClientExceptionInterface | Exception | TransportExceptionInterface */
    #[Route('/smsc/{connectionId}/send_sms', name: 'sendSms')]
    public function sendSms(Request $request, int $connectionId): JsonResponse
    {
        $requestUri = $request->getRequestUri();
        $requestParams = $request->query->all();
        $content = $this->sendSmsCommand->execute($requestUri, $requestParams, $connectionId);

        return new JsonResponse($content);
    }
}
