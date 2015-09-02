<?php

namespace MyLibrary\Book;

class BookWasEdited
{
    public $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
}
