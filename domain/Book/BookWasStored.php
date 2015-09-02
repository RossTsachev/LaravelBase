<?php

namespace MyLibrary\Book;

class BookWasStored
{
    public $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
}
