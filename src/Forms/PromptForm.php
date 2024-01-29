<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI\Forms;

use VitesseCms\Form\AbstractForm;
use VitesseCms\Form\Models\Attributes;

final class PromptForm extends AbstractForm
{
    public function buildForm(): void
    {
        $this->addText('Je prompt', 'prompt', (new Attributes())->setRequired());
        $this->addSubmitButton('Stel je vraag');
    }
}