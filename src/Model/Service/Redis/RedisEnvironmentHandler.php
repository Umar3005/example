<?php

namespace App\Model\Service\Redis;

class RedisEnvironmentHandler
{
    public static function getRedisEnv(): array
    {
        return [
            'host'     => $_ENV['REDIS_HOST'],
            'port'     => $_ENV['REDIS_PORT'],
            'password' => $_ENV['REDIS_PASSWORD'],
        ];
    }
}
