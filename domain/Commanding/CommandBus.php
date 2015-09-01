<?php

namespace MyLibrary\Commanding;

use Illuminate\Foundation\Application;

class CommandBus
{
    protected $commandTranslator;
    protected $app;

    public function __construct(Application $app, CommandTranslator $commandTranslator)
    {
        $this->commandTranslator = $commandTranslator;
        $this->app = $app;
    }

    public function execute($command)
    {
        $handler = $this->commandTranslator->toCommandHandler($command);
        $this->app->make($handler)->handle($command);
    }
}
