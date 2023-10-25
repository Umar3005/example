<?php

namespace App\Model\Factory;

use App\Entity\Interface\SettingsInterface;
use App\Entity\Settings;
use App\Model\Factory\Interface\BaseFactoryInterface;

class SettingsFactory implements BaseFactoryInterface
{
    public function create(array $data): SettingsInterface
    {
        $settingsEntity = new Settings();

        if (isset($data[SettingsInterface::CONNECTION_ID_FIELD])) {
            $settingsEntity->setConnectionId($data[SettingsInterface::CONNECTION_ID_FIELD]);
        }

        if (isset($data[SettingsInterface::PROTOCOL_FIELD])) {
            $settingsEntity->setProtocol($data[SettingsInterface::PROTOCOL_FIELD]);
        }

        if (isset($data[SettingsInterface::DOMAIN_FIELD])) {
            $settingsEntity->setDomain($data[SettingsInterface::DOMAIN_FIELD]);
        }

        if (isset($data[SettingsInterface::CHECK_URL_FIELD])){
            $settingsEntity->setCheckUrl($data[SettingsInterface::CHECK_URL_FIELD]);
        }

        if (isset($data[SettingsInterface::SEND_RESPONSE_WITH_TIMEOUT_FIELD])) {
            $settingsEntity->setSendResponseWithTimeout($data[SettingsInterface::SEND_RESPONSE_WITH_TIMEOUT_FIELD]);
        }

        if (isset($data[SettingsInterface::RESPONSE_DELAY_TIME_FIELD])) {
            $settingsEntity->setResponseDelayTime($data[SettingsInterface::RESPONSE_DELAY_TIME_FIELD]);
        }

        return $settingsEntity;
    }
}
