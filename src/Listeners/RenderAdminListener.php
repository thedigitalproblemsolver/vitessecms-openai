<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Listeners;

use VitesseCms\Media\Services\AssetsService;

final class RenderAdminListener
{
    public function __construct(private readonly AssetsService $assetsService, private readonly string $vendorBaseDir)
    {
    }

    public function loadGeneric(): void
    {
        $this->assetsService->loadFontAwesome();
        $content = file_get_contents($this->vendorBaseDir.'openai/src/Resources/js/initOpenAIUI.js');
        if (is_string($content)) {
            $this->assetsService->addInlineJs($content);
        }
    }
}
