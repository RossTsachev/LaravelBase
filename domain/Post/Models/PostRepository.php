<?php

namespace MyLibrary\Post\Models;

use Event;

use MyLibrary\Post\Models\Post;

use MyLibrary\Post\Events\PostWasStored;

class PostRepository implements PostRepositoryInterface
{
    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function store($userId, $bookId, $post)
    {
        $this->post->user_id = $userId;
        $this->post->book_id = $bookId;
        $this->post->comment = $post;
        $this->post->save();

        Event::fire(new PostWasStored($this));

        return $this;
    }
}
