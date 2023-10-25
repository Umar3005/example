<?php

namespace App\Model\Service\Redis;

use App\Model\Service\Redis\Interface\RedisClientInterface;
use Exception;
use Predis\Client;

class RedisClient implements RedisClientInterface
{
    private static Client $client;

    protected function __construct() { }

    /** @throws Exception */
    protected function __clone()
    {
        throw new Exception('Cannot clone a singleton');
    }

    protected static function createRedisClient(): Client
    {
        self::$client = new Client(RedisEnvironmentHandler::getRedisEnv());
        return self::$client;
    }


    /** @inheritDoc */
    public function __wakeup()
    {
        throw new Exception('Cannot unserialize a singleton');
    }

    public static function getRedisClient(): Client
    {
        if (isset(self::$client)) {
            return self::$client;
        }

        return self::createRedisClient();
    }
}
