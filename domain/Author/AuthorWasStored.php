<?php

namespace MyLibrary\Author;

class AuthorWasStored
{
    public $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }
}
