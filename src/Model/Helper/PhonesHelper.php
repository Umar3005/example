<?php

namespace App\Model\Helper;

class PhonesHelper
{
    public function getPhone(string $requestUri): string
    {
        preg_match('/phones=.+?(?=&|$)/', $requestUri, $phonesFromUri);
        $phoneInArray = str_replace(['phones=', '+'], ['', '%2B'], $phonesFromUri);
        return reset($phoneInArray);
    }
}
