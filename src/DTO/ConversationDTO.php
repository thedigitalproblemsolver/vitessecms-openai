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
        private readonly string $retutnType = 'html'
    ) {
    }

    public function getCurlData(): array
    {
        return [
            'model' => $this->model,
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $this->systemContent
                ],
                [
                    'role' => 'user',
                    'content' => $this->userContent . match ($this->retutnType) {
                            default => ' Please do the html formatting of the content.'
                        }
                ],
            ],
        ];
    }

    public function getCurlHeader(): array
    {
        return [
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json'
        ];
    }
}