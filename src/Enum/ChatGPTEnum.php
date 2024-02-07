<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Enum;

enum ChatGPTEnum: string
{
    case ATTACH_SERVICE_LISTENER = 'ChatGPTListener:attach';
    case SERVICE_LISTENER = 'ChatGPTListener';
}