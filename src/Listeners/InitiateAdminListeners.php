<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Listeners;

use VitesseCms\Core\Interfaces\InjectableInterface;
use VitesseCms\Media\Enums\MediaEnum;

class InitiateAdminListeners
{
    public static function setListeners(InjectableInterface $di): void
    {
        $di->eventsManager->attach(
            MediaEnum::ASSETS_LOAD_GENERIC,
            new RenderAdminListener($di->assets, $di->configuration->getVendorNameDir()),
            1
        );
    }
}