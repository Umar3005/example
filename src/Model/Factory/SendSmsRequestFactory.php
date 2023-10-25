<?php

namespace App\Model\Factory;

use App\Model\Entity\Interface\SendSmsRequestEntityInterface;
use App\Model\Entity\SendSmsRequestEntity;
use App\Model\Factory\Interface\BaseFactoryInterface;

class SendSmsRequestFactory implements BaseFactoryInterface
{
    public function create(array $data): SendSmsRequestEntityInterface
    {
        $sendSmsRequestEntity = new SendSmsRequestEntity();

        if (isset($data[SendSmsRequestEntityInterface::LOGIN])) {
            $sendSmsRequestEntity->setLogin($data[SendSmsRequestEntityInterface::LOGIN]);
        }

        if (isset($data[SendSmsRequestEntityInterface::MESSAGE])) {
            $sendSmsRequestEntity->setMessage($data[SendSmsRequestEntityInterface::MESSAGE]);
        }

        if (isset($data[SendSmsRequestEntityInterface::PASSWORD])) {
            $sendSmsRequestEntity->setPassword($data[SendSmsRequestEntityInterface::PASSWORD]);
        }

        if (isset($data[SendSmsRequestEntityInterface::SHORTEN_URL])) {
            $sendSmsRequestEntity->setShortenUrl($data[SendSmsRequestEntityInterface::SHORTEN_URL]);
        }

        if (isset($data[SendSmsRequestEntityInterface::VIBER_BUTTON_URL])) {
            $sendSmsRequestEntity->setViberButtonUrl($data[SendSmsRequestEntityInterface::VIBER_BUTTON_URL]);
        }

        return $sendSmsRequestEntity;
    }
}
