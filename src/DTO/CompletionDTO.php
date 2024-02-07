<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\DTO;

final class CompletionDTO
{
    public function __construct(private readonly array $data)
    {
    }

    public function getMessage(): string
    {
        return $this->data['choices'][0]['message']['content'];
    }
}