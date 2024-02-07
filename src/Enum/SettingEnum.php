<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Enum;

enum SettingEnum: string
{
    case CHATGPT_BASE_AGENTS = 'CHATGPT_BASE_AGENTS';
    case CHATGPT_BASE_PROMPTS = 'CHATGPT_BASE_PROMPTS';
}