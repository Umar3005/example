<?php

namespace App\Model\Service;

use App\Model\Service\Interface\ShortLinkProcessorInterface;
use Exception;

class ShortLinkProcessor implements ShortLinkProcessorInterface
{
    /** @inheritDoc */
    public function createShortUrl(): string
    {
        return substr($this->getString(), 0, self::SHORT_URL_LENGTH);
    }


    /** @throws Exception */
    private function getString(): string
    {
        return base64_encode(sha1(uniqid(random_bytes(self::RANDOM_BYTES), true)));
    }
}
