<?php

namespace App\Command;

use App\Model\Service\Redis\RedisClient;
use App\Model\Service\ShortLinkProcessor;
use App\Repository\LinkRepository;
use App\Repository\LoggerRepository;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:gen-links')]
class GenLinksCommand extends Command
{
    private ShortLinkProcessor $linkProcessor;

    private LinkRepository $linkRepository;

    private LoggerRepository $loggerRepository;

    public function __construct(
        ShortLinkProcessor $linkProcessor,
        LinkRepository $linkRepository,
        LoggerRepository $loggerRepository
    ) {
        parent::__construct();
        $this->linkProcessor    = $linkProcessor;
        $this->linkRepository   = $linkRepository;
        $this->loggerRepository = $loggerRepository;
    }

    /** @throws Exception */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $redisClient = RedisClient::getRedisClient();

        if ($redisClient->hget('task_links', 'gen-links') !== 1) {
            $output->writeln('\'task_links\' value is not equal 1');
            return Command::INVALID;
        }

        $countUnusedUrls = $this->linkRepository->count(['original_url' => NULL]);
        $neededLinks = (int) $_ENV['URLS_QTY'] - $countUnusedUrls;
        if ($neededLinks === 0) {
            $output->writeln('New Url\'s are not needed');
            return Command::INVALID;
        }

        ini_set('memory_limit', $_ENV['MEMORY_LIMIT']);
        $start = microtime(true);

        $shortUrls = $this->getShortUrls($neededLinks);
        $this->linkRepository->saveShortUrls($shortUrls);

        $this->loggerRepository->log(['status' => 'OK', 'qty' => $neededLinks, 'time' => microtime(true) - $start]);

        $redisClient->hset('task_links', 'gen-links', 0);

        return Command::SUCCESS;
    }


    /** @throws Exception */
    private function getShortUrls(int $neededLinks): array
    {
        $shortUrls = [];

        for ($i = 0; $i < $neededLinks; $i++) {
            do {
                $url = $this->linkProcessor->createShortURL();
                $isDuplicate = in_array($url, $shortUrls);

                if (!$isDuplicate) {
                    $shortUrls[] = $url;
                }
            } while ($isDuplicate);
        }

        return $shortUrls;
    }
}
