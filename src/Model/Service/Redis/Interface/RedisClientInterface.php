<?php

namespace App\Model\Service\Redis\Interface;

use Predis\Client;
use Exception;

interface RedisClientInterface
{
    /** @throws Exception */
    public function __wakeup();

    public static function getRedisClient(): Client;
}
