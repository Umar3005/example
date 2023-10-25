<?php

namespace App\Command;

use App\Model\Service\Redis\RedisClient;
use App\Repository\LinkRepository;
use App\Repository\SettingsRepository;
//use Doctrine\Common\Cache\PredisCache;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Common\Cache\Psr6\DoctrineProvider;

#[AsCommand(name: 'app:replace-links')]
class ReplaceLinksCommand extends Command
{
    use LockableTrait;

    private EntityManagerInterface $entityManager;

    private LoggerInterface $consoleLogger;

    private LinkRepository $linkRepository;

    private SettingsRepository $settingsRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        LoggerInterface $consoleLogger,
        LinkRepository $linkRepository,
        SettingsRepository $settingsRepository
    ) {
        parent::__construct();
        $this->entityManager      = $entityManager;
        $this->consoleLogger      = $consoleLogger;
        $this->linkRepository     = $linkRepository;
        $this->settingsRepository = $settingsRepository;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->lock()) {
            return false;
        }

        $redisClient = RedisClient::getRedisClient();

        do {
            $message = json_decode($redisClient->blpop('platform_message_queue', '1')[1] ?? null);
        } while (!$message);

        $cachePool = new RedisAdapter($redisClient);
        $cache = DoctrineProvider::wrap($cachePool);
        $settings = $cache->fetch('settings');
        if (!$settings) {
            $settings = $this->settingsRepository->findAll();
            $cache->save('settings', $settings);
        }

        $setting = $this->getSetting($settings, $message->connection_id);

        if ($setting) {
            preg_match_all("/(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9-А-Я+&@#\/%=~_|$?!:.]*\)|[-A-Z0-9-А-Я+&@#\/%=~_|$?!:.])*(?:\([-A-Z-А-Я0-9+&@#\/%=~_|$?!:,.]*\)|[A-Z0-9-А-Я+&@#\/%=~_|$])/imu", $message->text, $matches);

            foreach ($matches[0] as $originalUrl) {
                $shortLink = $redisClient->lpop('links');
                $this->linkRepository->attachUrlToLink($originalUrl, $shortLink);
                $message->text = str_replace($originalUrl, $setting[0]->getDomain() . '/' . $shortLink, $message->text);
            }

            $redisClient->lpush('platform_replaced_messages', json_encode($message));

            $this->consoleLogger->log(LogLevel::INFO, 'Links in message: ' . $message->uuid . ' has been replaced! Message published to corresponding queue. Sent message: ', (array) $message);
        }

        $this->release();
        return Command::SUCCESS;
    }


    private function getSetting(array $settings, int $connectionId): array
    {
        return array_values(array_filter(
            $settings,
            function ($e) use ($connectionId) {
                return $e->getConnectionId() === $connectionId;
            }
        ));
    }
}
