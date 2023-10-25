<?php

namespace App\Model\Command;

use App\Entity\Response;
use App\Model\Factory\SendSmsRequestFactory;
use App\Model\Handler\Error\PhonesErrorHandler;
use App\Model\Handler\Error\SettingsErrorHandler;
use App\Model\Handler\Error\TurnConnectInErrorHandler;
use App\Model\Helper\LinkHelper;
use App\Model\Helper\PhonesHelper;
use App\Model\Service\Redis\RedisClient;
use App\Model\SettingsModel;
use App\Model\TurnConnectInModel;
use App\Repository\LinkRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class SendSmsCommand
{
    private SendSmsRequestFactory $smsRequestFactory;

    private TurnConnectInModel $turnConnectInModel;

    private TurnConnectInErrorHandler $turnConnectInErrorHandler;

    private PhonesErrorHandler $phonesErrorHandler;

    private PhonesHelper $phonesHelper;

    private SettingsModel $settingsModel;

    private SettingsErrorHandler $settingsErrorHandler;

    private LinkHelper $linkHelper;

    private LinkRepository $linkRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(
        SendSmsRequestFactory $smsRequestFactory,
        TurnConnectInModel $turnConnectInModel,
        TurnConnectInErrorHandler $turnConnectInErrorHandler,
        PhonesErrorHandler $phonesErrorHandler,
        PhonesHelper $phonesHelper,
        SettingsModel $settingsModel,
        SettingsErrorHandler $settingsErrorHandler,
        LinkHelper $linkHelper,
        LinkRepository $linkRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->smsRequestFactory = $smsRequestFactory;
        $this->turnConnectInModel = $turnConnectInModel;
        $this->turnConnectInErrorHandler = $turnConnectInErrorHandler;
        $this->phonesErrorHandler = $phonesErrorHandler;
        $this->phonesHelper = $phonesHelper;
        $this->settingsModel = $settingsModel;
        $this->settingsErrorHandler = $settingsErrorHandler;
        $this->linkHelper = $linkHelper;
        $this->linkRepository = $linkRepository;
        $this->entityManager = $entityManager;
    }

    /** @throws TransportExceptionInterface | ServerExceptionInterface | RedirectionExceptionInterface | ClientExceptionInterface */
    public function execute(string $requestUri, array $urlParams, int $connectionId): array
    {
        $clientRedis = RedisClient::getRedisClient();

        $url = $_ENV['SMSC_API_URL'] . $requestUri;

        $sendSmsRequestEntity = $this->smsRequestFactory->create($urlParams);

        $generatedLinks = [];

        if ($sendSmsRequestEntity->getShortenUrl() === 1) {
            $phone = $this->phonesHelper->getPhone($requestUri);
            if (!$phone) {
                return $this->phonesErrorHandler->handlePhonesError();
            }

            $connectIn = $this->turnConnectInModel->getTurnConnectByCredentials($sendSmsRequestEntity->getLogin(), $sendSmsRequestEntity->getPassword());
            if (!$connectIn) {
                return $this->turnConnectInErrorHandler->handleConnectAuthorizationError();
            }

            $settings = $this->settingsModel->getSettingsByConnectionId($connectionId);
            if (!$settings) {
                return $this->settingsErrorHandler->handleSettingsError();
            }

            $message = $sendSmsRequestEntity->getMessage();
            $links = $this->linkHelper->getLinks($message);
            if ($settings->getCheckUrl() === 1 && !$links) {
                return $this->settingsErrorHandler->handleCheckUrlError();
            }

            $newUrl = preg_replace('/&phones=.+?(?=&|$)/', '&phones=' . $phone, $requestUri);

            foreach ($links as $link) {
                $shortLink = $clientRedis->lpop('links');
                $this->linkRepository->attachUrlToLink($link, $shortLink);
                $generatedLinks[] = $shortLink;
                $newMessage = str_replace($link, $settings->getDomain() . '/' . $shortLink, $message);
                $newUrl = preg_replace('/&mes=.+?(?=&|$)/', '&mes=' . urlencode($newMessage), $newUrl);
            }

            $viberButtonUrl = $sendSmsRequestEntity->getViberButtonUrl();
            if (isset($viberButtonUrl)){
                $viberShortLink = $clientRedis->lpop('links');
                $this->linkRepository->attachUrlToLink($viberButtonUrl, $viberShortLink);
                $generatedLinks[] = $viberButtonUrl;
                $viberButtonUrl = str_replace($viberButtonUrl, $settings->getProtocol() . '://' . $settings->getDomain() . '/' . $viberShortLink, $viberButtonUrl);
                $newUrl = preg_replace('/&viber_button_url=.+?(?=&|$)/', '&viber_button_url=' . $viberButtonUrl, $newUrl);
            }
            $url = $_ENV['SMSC_API_URL'] . $newUrl;
        }

        $http = HttpClient::create();
        $res = $http->request('GET', $url);
        $content = json_decode($res->getContent(), true);

        $response = new Response();
        $response->setConnectionId($connectionId);
        $response->setCreatedAt(new DateTimeImmutable('now'));
        $response->setUpdatedAt(new DateTimeImmutable('now'));
        if (!isset($content['error'])) {
            foreach ($generatedLinks as $link) {
                $response->setUuid($content['id']);
                $response->setPhone($content['phones'][0]['phone'] ?? 'load_test');
                $response->setStatus($content['phones'][0]['status'] ?? 'load_test');
                $response->setLink($link ?? '');
                $this->entityManager->persist($response);
            }
        } else {
            $response->setUuid('failed');
            $response->setPhone($url);
            $response->setStatus('failed');
            $response->setLink($message ?? '');
            $this->entityManager->persist($response);
        }
        $this->entityManager->flush();

        return $content;
    }
}
