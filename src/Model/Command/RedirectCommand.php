<?php

namespace App\Model\Command;

use App\Model\Service\Redis\RedisClient;
use App\Model\Service\ResponseProcessor;
use App\Repository\LinkRepository;
use App\Repository\Platform\TurnConnectInRepository;
use App\Repository\ResponseRepository;
use App\Repository\SettingsRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\Exception\TransportException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class RedirectCommand
{
    protected EntityManagerInterface $entityManager;

    protected LinkRepository $linkRepository;

    protected ResponseProcessor $responseProcessor;

    protected SettingsRepository $settingsRepository;

    protected TurnConnectInRepository $connectInRepository;

    protected ResponseRepository $responseRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        LinkRepository $linkRepository,
        ResponseProcessor $responseProcessor,
        SettingsRepository $settingsRepository,
        TurnConnectInRepository $connectInRepository,
        ResponseRepository $responseRepository
    ) {
        $this->entityManager       = $entityManager;
        $this->linkRepository      = $linkRepository;
        $this->responseProcessor   = $responseProcessor;
        $this->settingsRepository  = $settingsRepository;
        $this->responseRepository  = $responseRepository;
        $this->connectInRepository = $connectInRepository;
    }

    /** @throws TransportExceptionInterface */
    public function execute(?string $link): ?string
    {
        $clientRedis = RedisClient::getRedisClient();

        $redirectUrl = $this->linkRepository->findOneBy(['short_url' => $link]);
        if (!isset($redirectUrl)) {
            throw new TransportException('Not found redirect URL');
        }

        $response = $this->responseRepository->findOneBy(['link' => $link]);
        $originalUrl = $redirectUrl->getOriginalUrl();
        if (!$response) {
            return $originalUrl;
        }

        $responseConnectionId = $response->getConnectionId() ?? null;
        $connect = $this->connectInRepository->findOneBy(['sId' => $responseConnectionId]);
        if (!$connect) {
            return $originalUrl;
        }

        $settings = $this->settingsRepository->findBy(['connection_id' => $responseConnectionId]);
        if (!$settings) {
            $this->responseProcessor->sendResponse((array)$response, $connect);
            return $originalUrl;
        }

        $clientRedis->lpush('send_with_timeout', [$response->getUuid()]);
        $response->setUpdatedAt((new DateTimeImmutable()));
        $this->entityManager->persist($response);
        $this->entityManager->flush();

        return $originalUrl;
    }
}
