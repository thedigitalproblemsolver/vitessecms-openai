<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Controllers;

use VitesseCms\Core\AbstractControllerAdmin;
use VitesseCms\OpenAI\DTO\ConversationDTO;
use VitesseCms\OpenAI\Forms\PromptForm;

final class AdminchatgptController extends AbstractControllerAdmin
{
    public function promptFormAction()
    {
        $promptForm = new PromptForm();
        $promptForm->buildForm();

        $this->view->set('content', $promptForm->renderForm('admin/openai/adminchatgpt/handlepromptform'));
    }

    public function HandlePromptFormAction(): void
    {
        $promptForm = new PromptForm();
        $promptForm->buildForm();
        if ($promptForm->validate()) {
            $conversationDTO = new ConversationDTO(
                getenv('CHATGPT_API_KEY'),
                'gpt-3.5-turbo',
                'You are a SEO specialist.',
                $this->request->getPost('prompt')
            );

            $ch = curl_init('https://api.openai.com/v1/chat/completions');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($conversationDTO->getCurlData()));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $conversationDTO->getCurlHeader());

            $response = curl_exec($ch);
            curl_close($ch);

            if (is_string($response)) {
                $response_data = json_decode($response, true);
                $assistant_reply = $response_data['choices'][0]['message']['content'];
                $this->view->set('content', $assistant_reply);
            } else {
                $this->flashService->setError('Prompt failed');
                $this->redirect($this->request->getHTTPReferer());
            }
        }
    }
}

