<?php

namespace MyLibrary\Book\Models;

use Event;

use MyLibrary\Book\Models\Book;

use MyLibrary\Book\Events\BookWasStored;
use MyLibrary\Book\Events\BookWasEdited;

class BookRepository implements BookRepositoryInterface
{
    public $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function find($id)
    {
        return Book::findOrFail($id);
    }

    public function store($title, $authors)
    {
        $this->book->title = $title;
        $this->book->save();
        $this->book->authors()->sync($authors);

        Event::fire(new BookWasStored($this));

        return $this;
    }

    public function edit($id, $title, $authors)
    {
        $this->book = $this->find($id);

        $this->book->title = $title;
        $this->book->save();
        $this->book->authors()->sync($authors);

        Event::fire(new BookWasEdited($this));

        return $this;
    }
}
