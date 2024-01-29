<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\DTO;

final class ConversationDTO
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $model,
        private readonly string $systemContent,
        private readonly string $userContent,
        private readonly string $returnType = 'html'
    ) {
    }

    public function getCurlData(): array
    {
        return [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $this->systemContent,
                ],
                [
                    'role' => 'user',
                    'content' => $this->userContent.match ($this->returnType) {
                        'html' => ' Please do the html formatting of the content.',
                        default => ''
                    },
                ],
            ],
        ];
    }

    public function getCurlHeader(): array
    {
        return [
            'Authorization: Bearer '.$this->apiKey,
            'Content-Type: application/json',
        ];
    }
}
