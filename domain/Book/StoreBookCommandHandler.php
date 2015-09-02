<?php

namespace MyLibrary\Book;

use MyLibrary\Commanding\CommandHandler;
use MyLibrary\Eventing\EventDispatcher;

class StoreBookCommandHandler implements CommandHandler
{
    protected $book;
    protected $dispatcher;

    public function __construct(
        Book $book,
        EventDispatcher $dispatcher
    ) {
        $this->book = $book;
        $this->dispatcher = $dispatcher;
    }

    public function handle($command)
    {
        $book = $this->book->store(
            $command->title,
            $command->authors
        );
        $this->dispatcher->dispatch(
            $book->releaseEvents()
        );
    }
}
