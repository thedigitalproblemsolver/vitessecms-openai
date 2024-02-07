<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Listeners\Services;

use VitesseCms\OpenAI\Services\ChatGPTService;

final class ChatGPTServiceListener
{
    public function __construct(private readonly ChatGPTService $chatGPTService)
    {
    }

    public function attach(): ChatGPTService
    {
        return $this->chatGPTService;
    }
}