<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Listeners;

use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Media\Enums\MediaEnum;
use VitesseCms\OpenAI\Enum\ChatGPTEnum;
use VitesseCms\OpenAI\Enum\PromptFormEnum;
use VitesseCms\OpenAI\Listeners\Forms\PromptFormListener;
use VitesseCms\OpenAI\Listeners\Services\ChatGPTServiceListener;
use VitesseCms\OpenAI\Services\ChatGPTService;

class InitiateAdminListeners
{
    public static function setListeners(InjectableInterface $injectable): void
    {
        $injectable->eventsManager->attach(
            MediaEnum::ASSETS_LOAD_GENERIC,
            new RenderAdminListener($injectable->assets, $injectable->configuration->getVendorNameDir()),
            1
        );
        $injectable->eventsManager->attach(
            ChatGPTEnum::SERVICE_LISTENER->value,
            new ChatGPTServiceListener(new ChatGPTService())
        );
        $injectable->eventsManager->attach(
            PromptFormEnum::LISTENER->value,
            new PromptFormListener($injectable->assets)
        );
    }
}