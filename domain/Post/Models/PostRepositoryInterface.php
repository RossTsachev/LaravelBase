<?php

namespace MyLibrary\Post\Models;

interface PostRepositoryInterface
{
    public function store($userId, $bookId, $post);
}
