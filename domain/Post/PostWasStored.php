<?php

namespace MyLibrary\Post;

class PostWasStored
{
    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }
}
