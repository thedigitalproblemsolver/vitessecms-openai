<?php

declare(strict_types=1);

namespace VitesseCms\OpenAI;

use Phalcon\Di\DiInterface;
use VitesseCms\Core\AbstractModule;

class Module extends AbstractModule
{
    public function registerServices(DiInterface $di, string $module = null)
    {
        parent::registerServices($di, 'OpenAI');
    }
}
