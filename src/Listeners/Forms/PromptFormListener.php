<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Listeners\Forms;

use VitesseCms\Media\Services\AssetsService;

final class PromptFormListener
{
    public function __construct(private readonly AssetsService $assetsService)
    {
    }

    public function buildJavascript(): void
    {
        $contents = file_get_contents(__DIR__.'/../../Resources/js/promptForm.js');
        if ($contents) {
            $this->assetsService->addInlineJs($contents);
        }
    }
}