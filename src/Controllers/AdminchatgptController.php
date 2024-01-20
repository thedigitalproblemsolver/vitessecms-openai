<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Controllers;

use VitesseCms\Core\AbstractControllerAdmin;

final class AdminchatgptController extends AbstractControllerAdmin
{
    public function promptAction(): void
    {
        $api_key = getenv('CHATGPT_API_KEY');

        $conversation = [
            ["role" => "system", "content" => "You are a SEO specialist."],
            [
                "role" => "user",
                "content" => "schrijf 3 alinea's voor een webshop over het product 'HEMA Nijntje Plakboek Blanco'"
            ],
        ];

        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => $conversation,
        ];

        $headers = [
            'Authorization: Bearer ' . $api_key,
            'Content-Type: application/json',
        ];

        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $response_data = json_decode($response, true);
        $assistant_reply = $response_data['choices'][0]['message']['content'];
        echo "Assistant: " . $assistant_reply;

        echo 'in prompt action';
        die();
    }
}

