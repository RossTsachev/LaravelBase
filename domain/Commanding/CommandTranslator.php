<?php

namespace MyLibrary\Commanding;

use Exception;

class CommandTranslator
{
    public function toCommandHandler($command)
    {
        $handler = get_class($command);
        $handler = str_replace('Command', 'CommandHandler', $handler);

        if (!class_exists($handler)) {
            $message = 'Command handler [$handler] does not exist.';
            throw new Exception($message);
        }

        return $handler;
    }
}
