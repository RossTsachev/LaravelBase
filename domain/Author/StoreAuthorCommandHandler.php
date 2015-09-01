<?php

namespace MyLibrary\Author;

use MyLibrary\Commanding\CommandHandler;
use MyLibrary\Eventing\EventDispatcher;

class StoreAuthorCommandHandler implements CommandHandler
{
    protected $author;
    protected $dispatcher;

    public function __construct(
        Author $author,
        EventDispatcher $dispatcher
    ) {
        $this->author = $author;
        $this->dispatcher = $dispatcher;
    }


    public function handle($command)
    {
        $author = $this->author->store(
            $command->name
        );

        $this->dispatcher->dispatch(
            $author->releaseEvents()
        );
    }
}
