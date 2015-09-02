<?php

namespace MyLibrary\Post;

use MyLibrary\Commanding\CommandHandler;
use MyLibrary\Eventing\EventDispatcher;

class StorePostCommandHandler implements CommandHandler
{
    protected $post;
    protected $dispatcher;

    public function __construct(Post $post, EventDispatcher $dispatcher)
    {
        $this->post = $post;
        $this->dispatcher = $dispatcher;
    }

    public function handle($command)
    {
        $post = $this->post->store(
            $command->userId,
            $command->bookId,
            $command->post
        );
        $this->dispatcher->dispatch(
            $post->releaseEvents()
        );
    }
}
