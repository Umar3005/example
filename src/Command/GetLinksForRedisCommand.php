<?php

namespace App\Command;

use App\Model\Service\Redis\RedisClient;
use App\Repository\LinkRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:get-links-for-redis')]
class GetLinksForRedisCommand extends Command
{
    use LockableTrait;

    private LinkRepository $linkRepository;

    public function __construct(LinkRepository $linkRepository)
    {
        parent::__construct();
        $this->linkRepository = $linkRepository;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process');
            return Command::FAILURE;
        }

        $redisClient = RedisClient::getRedisClient();

        $cachedLinks = $redisClient->lrange('links', 0, -1);


        ini_set('memory_limit', $_ENV['MEMORY_LIMIT']);
        if (count($cachedLinks) < $_ENV['CACHED_LINKS_QTY']) {
            $this->pushLinksToRedis($cachedLinks);
        }

        $this->release();

        return Command::SUCCESS;
    }


    private function pushLinksToRedis(array $cachedLinks): void
    {
        $redisClient = RedisClient::getRedisClient();

        $flippedCachedLinks = array_flip($cachedLinks);
        $links = $this->linkRepository->getLinksForRedis($_ENV['CACHED_LINKS_QTY']);
        foreach ($links as $link) {
            if (!isset($flippedCachedLinks[$link])){
                $redisClient->lpush('links', $link);
            }
        }
    }
}
