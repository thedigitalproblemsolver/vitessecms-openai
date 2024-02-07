<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Controllers;

use VitesseCms\Install\AbstractCreatorController;
use VitesseCms\OpenAI\Enum\SettingEnum;
use VitesseCms\Setting\Enum\TypeEnum;

final class AdmininstallController extends AbstractCreatorController
{
    public function createAction(): void
    {
        $settings = [];

        if (!$this->setting->has(SettingEnum::CHATGPT_BASE_AGENTS->value, false)) {
            $settings[SettingEnum::CHATGPT_BASE_AGENTS->value] = [
                'type' => TypeEnum::TEXTAREA,
                'value' => '',
                'name' => 'ChatGPT base Agents for use in form. One per line.',
            ];
        }
        if (!$this->setting->has(SettingEnum::CHATGPT_BASE_PROMPTS->value, false)) {
            $settings[SettingEnum::CHATGPT_BASE_PROMPTS->value] = [
                'type' => TypeEnum::TEXTAREA,
                'value' => '',
                'name' => 'ChatGPT base Prompts for use in form. One per line.',
            ];
        }

        $this->createSettings($settings);

        $this->flash->setSucces('OpenAI properties created');

        $this->redirect('admin/install/sitecreator/index');
    }
}
