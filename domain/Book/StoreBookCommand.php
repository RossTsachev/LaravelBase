<?php

namespace MyLibrary\Book;

class StoreBookCommand
{
    public $title;
    public $authors;

    public function __construct($title, $authors)
    {
        $this->title = $title;
        $this->authors = $authors;
    }
}
