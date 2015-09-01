<?php

namespace MyLibrary\Author;

class AuthorWasEdited
{
    public $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }
}
