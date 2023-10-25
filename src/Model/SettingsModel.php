<?php

namespace App\Model;

use App\Entity\Settings;
use App\Repository\SettingsRepository;

class SettingsModel
{
    private SettingsRepository $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function getSettingsByConnectionId(int $connectionId): ?Settings
    {
        return $this->settingsRepository->findOneBy(['connection_id' => $connectionId]);
    }
}
