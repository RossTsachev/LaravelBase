<?php

namespace MyLibrary\Post;

class StorePostCommand
{
    public $userId;
    public $bookId;
    public $post;

    public function __construct($userId, $bookId, $post)
    {
        $this->userId = $userId;
        $this->bookId = $bookId;
        $this->post = $post;
    }
}
