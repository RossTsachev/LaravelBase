<?php

namespace MyLibrary\Book;

class UpdateBookCommand
{
    public $id;
    public $title;
    public $authors;

    public function __construct($id, $title, $authors)
    {
        $this->id = $id;
        $this->title = $title;
        $this->authors = $authors;
    }
}
