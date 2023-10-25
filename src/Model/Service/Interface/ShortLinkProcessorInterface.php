<?php

namespace App\Model\Service\Interface;

use Exception;

interface ShortLinkProcessorInterface
{
    const RANDOM_BYTES     = 32;
    const SHORT_URL_LENGTH = 6;

    /** @throws Exception */
    public function createShortURL(): string;
}
