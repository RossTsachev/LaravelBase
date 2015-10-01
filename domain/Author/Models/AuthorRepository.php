<?php

namespace MyLibrary\Author\Models;

use Event;

use MyLibrary\Author\Models\Author;

use MyLibrary\Author\Events\AuthorWasStored;
use MyLibrary\Author\Events\AuthorWasEdited;

class AuthorRepository implements AuthorRepositoryInterface
{
    public $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    // to check if this is valid
    public function books()
    {
        return $this
            ->author
            ->belongsToMany('MyLibrary\Book\Models\Book')
            ->withTimestamps()
            ->select(['books.id', 'books.title']);
    }

    public function find($id)
    {
        return Author::findOrFail($id);
    }

    public function dropdown()
    {
        return Author::lists('name', 'id')->take(5);
    }

    public function store($name)
    {
        $this->author->name = $name;
        $this->author->save();
        Event::fire(new AuthorWasStored($this));
        return $this->author;
    }

    public function edit($id, $name)
    {
        $this->author = $this->find($id);
        $this->author->name = $name;
        $this->author->save();
        Event::fire(new AuthorWasEdited($this));
        return $this->author;
    }
}
