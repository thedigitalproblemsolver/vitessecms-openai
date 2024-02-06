<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Forms;

use VitesseCms\Form\AbstractForm;
use VitesseCms\Form\Helpers\ElementHelper;
use VitesseCms\Form\Models\Attributes;
use VitesseCms\Media\Enums\AssetsEnum;
use VitesseCms\Media\Services\AssetsService;
use VitesseCms\OpenAI\Enum\PromptFormEnum;
use VitesseCms\OpenAI\Enum\SettingEnum;
use VitesseCms\Setting\Services\SettingService;

final class PromptForm extends AbstractForm
{
    private SettingService $settingService;
    private AssetsService $assetsService;
    private bool $loadAssets = false;

    public function __construct($entity = null, array $userOptions = [])
    {
        parent::__construct($entity, $userOptions);

        $this->settingService = $this->eventsManager->fire(
            \VitesseCms\Setting\Enum\SettingEnum::ATTACH_SERVICE_LISTENER->value,
            new \stdClass()
        );
        $this->assetsService = $this->eventsManager->fire(AssetsEnum::ATTACH_SERVICE_LISTENER->value, new \stdClass());
    }

    public function buildForm(): void
    {
        $this->setDropdown(SettingEnum::CHATGPT_BASE_AGENTS->value, 'Basis agent');
        $this->addText('Je agent', 'chatgpt_agent', (new Attributes())->setRequired());
        $this->setDropdown(SettingEnum::CHATGPT_BASE_PROMPTS->value, 'Basis prompt');
        $this->addText('Je prompt', 'chatgpt_prompt', (new Attributes())->setRequired());
        $this->addSubmitButton('Stel je vraag');
        if ($this->loadAssets) {
            $this->assetsService->setEventLoader(PromptFormEnum::EVENT_BUILD_JAVASCRIPT->value);
        }
    }

    private function setDropdown(string $settingsKey, string $label): void
    {
        if (
            $this->settingService->has($settingsKey)
            && !empty($this->settingService->getString($settingsKey))
        ) {
            $valuesArray = explode(
                PHP_EOL,
                trim($this->settingService->getString($settingsKey))
            );
            if (0 < count($valuesArray)) {
                $this->addDropdown(
                    $label,
                    $settingsKey,
                    (new Attributes())->setOptions(
                        ElementHelper::arrayToSelectOptions(array_combine($valuesArray, $valuesArray))
                    )
                );
            }
            $this->loadAssets = true;
        }
    }
}