<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Enum;

enum PromptFormEnum: string
{
    case LISTENER = 'PromptFormListener';
    case EVENT_BUILD_JAVASCRIPT = 'PromptFormListener:buildJavascript';
}