<?php

namespace App\Command;

use App\Model\Service\Redis\RedisClient;
use App\Model\Service\ResponseProcessor;
use App\Repository\Platform\TurnConnectInRepository;
use App\Repository\ResponseRepository;
use App\Repository\SettingsRepository;
use DateTime;
use Doctrine\DBAL\Exception;
use Exception as CoreException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

#[AsCommand(name: 'app:send_with_timeout')]
class SendWithTimeoutCommand extends Command
{
    use LockableTrait;

    private ResponseProcessor $responseProcessor;

    private SettingsRepository $settingsRepository;

    private ResponseRepository $responseRepository;

    private TurnConnectInRepository $turnConnectInRepository;

    public function __construct(
        ResponseProcessor $responseProcessor,
        SettingsRepository $settingsRepository,
        ResponseRepository $responseRepository,
        TurnConnectInRepository $turnConnectInRepository
    ) {
        parent::__construct();
        $this->responseProcessor       = $responseProcessor;
        $this->settingsRepository      = $settingsRepository;
        $this->responseRepository      = $responseRepository;
        $this->turnConnectInRepository = $turnConnectInRepository;
    }


    /** @throws Exception | TransportExceptionInterface | CoreException */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');
            return Command::FAILURE;
        }

        $uuids = $this->getUuids();
        if (empty($uuids)) {
            $this->release();
            return Command::SUCCESS;
        }

        $responses = $this->responseRepository->getResponseArray($uuids);
        $connectionIds = array_unique(array_column($responses, 'connection_id'));

        $sentUuids = $this->sendResponses($connectionIds, $responses);

        foreach ($sentUuids as $sentUuid) {
            $output->writeln('Response with uuid = ' . $sentUuid . ' has been sent');
        }

        $this->release();
        return Command::SUCCESS;
    }


    private function getUuids(): array
    {
        return RedisClient::getRedisClient()->lrange('send_with_timeout', 0, -1);
    }

    /** @throws TransportExceptionInterface | CoreException */
    private function sendResponses(array $connectionIds, array $responses): array
    {
        $settings = $this->settingsRepository->getDelayByConnectionId($connectionIds)->getResult();
        $connects = $this->turnConnectInRepository->getConnectionsByConnectIds($connectionIds)->getResult();
        $sentUuids = [];
        foreach ($responses as $response) {
            $connectionId = $response['connection_id'];
            $canSend = $this->canSend($response['updated_at'], $connectionId, $settings);
            if (!$canSend) {
                continue;
            }
            $connect = $connects[$connectionId];
            $this->responseProcessor->sendResponse($response, $connect);
            RedisClient::getRedisClient()->lrem('send_with_timeout', 0, $response['uuid']);
            $sentUuids[] = $response['uuid'];
        }

        return $sentUuids;
    }

    /** @throws CoreException */
    private function canSend(string $updatedAt, int $connectionId, array $settings): bool
    {
        $diff = (new DateTime())->diff(new DateTime($updatedAt))->format('%i');
        if (isset($settings[$connectionId])) {
            return $diff >= $this->getResponseDelayTime($settings, $connectionId);
        }
        return false;
    }

    private function getResponseDelayTime(array $settings, int $connectionId): int
    {
        return $settings[$connectionId]['response_delay_time'];
    }
}
