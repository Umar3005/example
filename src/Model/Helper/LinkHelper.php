<?php

namespace App\Model\Helper;

class LinkHelper
{
    const EXPRESSION = '/(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9-А-Я+&@#\/%=~_|$?!:.]*\)|[-A-Z0-9-А-Я+&@#\/%=~_|$?!:.])*(?:\([-A-Z-А-Я0-9+&@#\/%=~_|$?!:,.]*\)|[A-Z0-9-А-Я+&@#\/%=~_|$])/imu';

    public function getLinks(string $message): array
    {
        preg_match_all("/(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9-А-Я+&@#\/%=~_|$?!:.]*\)|[-A-Z0-9-А-Я+&@#\/%=~_|$?!:.])*(?:\([-A-Z-А-Я0-9+&@#\/%=~_|$?!:,.]*\)|[A-Z0-9-А-Я+&@#\/%=~_|$])/imu", $message, $matches);
        return reset($matches);
    }
}
