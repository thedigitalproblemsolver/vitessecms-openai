<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Services;

use VitesseCms\OpenAI\DTO\CompletionDTO;
use VitesseCms\OpenAI\DTO\ConversationDTO;

final class ChatGPTService
{
    /**
     * @throws \Exception
     */
    public function conversation(ConversationDTO $conversationDTO): CompletionDTO
    {
        $curlInit = curl_init('https://api.openai.com/v1/chat/completions');
        if (false !== $curlInit) {
            curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curlInit, CURLOPT_POST, true);
            curl_setopt($curlInit, CURLOPT_POSTFIELDS, json_encode($conversationDTO->getCurlData()));
            curl_setopt($curlInit, CURLOPT_HTTPHEADER, $conversationDTO->getCurlHeader());

            $response = curl_exec($curlInit);
            curl_close($curlInit);

            if (is_string($response)) {
                return new CompletionDTO(json_decode($response, true));
            }
        }

        throw new \Exception('ChatGPT conversation failed');
    }
}