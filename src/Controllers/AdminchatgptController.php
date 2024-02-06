<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Controllers;

use VitesseCms\Content\Enum\ItemEnum;
use VitesseCms\Content\Models\Item;
use VitesseCms\Content\Repositories\ItemRepository;
use VitesseCms\Core\AbstractControllerAdmin;
use VitesseCms\OpenAI\DTO\ConversationDTO;
use VitesseCms\OpenAI\Enum\ChatGPTEnum;
use VitesseCms\OpenAI\Forms\PromptForm;
use VitesseCms\OpenAI\Services\ChatGPTService;

final class AdminchatgptController extends AbstractControllerAdmin
{
    protected ChatGPTService $chatGPTService;
    private ItemRepository $itemRepository;

    public function OnConstruct()
    {
        parent::OnConstruct();

        $this->itemRepository = $this->eventsManager->fire(ItemEnum::GET_REPOSITORY, new \stdClass());
        $this->chatGPTService = $this->eventsManager->fire(
            ChatGPTEnum::ATTACH_SERVICE_LISTENER->value,
            new \stdClass()
        );
    }

    public function promptFormAction(string $itemId): void
    {
        $promptForm = new PromptForm();
        $promptForm->buildForm();

        $this->viewService->set(
            'content',
            $promptForm->renderForm('admin/openai/adminchatgpt/handlepromptform/'.$itemId, 'promptForm')
        );
    }

    /**
     * @throws \Exception
     */
    public function handlePromptFormAction(string $itemId): void
    {
        $promptForm = new PromptForm();
        $promptForm->buildForm();
        $item = $this->itemRepository->getById($itemId);
        if (null === $item) {
            throw new \Exception('Item not found');
        }

        if ($promptForm->validate()) {
            $completionDTO = $this->chatGPTService->conversation(
                new ConversationDTO(
                    getenv('CHATGPT_API_KEY') ? getenv('CHATGPT_API_KEY') : '',
                    'gpt-3.5-turbo',
                    $this->request->getPost('chatgpt_agent'),
                    $this->replaceTags($item, $this->request->getPost('chatgpt_prompt'))
                )
            );

            $this->jsonResponse(['content' => $completionDTO->getMessage()]);
        }
    }

    private function replaceTags(Item $item, string $prompt): string
    {
        return str_replace('{ITEM_NAME}', $item->getNameField(), $prompt);
    }
}
