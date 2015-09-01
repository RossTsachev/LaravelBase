<?php

namespace MyLibrary\Commanding;

/**
 * handle the command
 */
interface CommandHandler
{
    public function handle($command);
}
