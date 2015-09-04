<?php

namespace MyLibrary\Author\Models;

use Event;
use Illuminate\Database\Eloquent\Model;

use MyLibrary\Author\Events\AuthorWasStored;
use MyLibrary\Author\Events\AuthorWasEdited;

class Author extends Model
{
    protected $fillable = [
        'name'
    ];

    public function books()
    {
        return $this
            ->belongsToMany('MyLibrary\Book\Models\Book')
            ->withTimestamps()
            ->select(['books.id', 'books.title']);
    }

    public function store($name)
    {
        $this->name = $name;
        $this->save();

        Event::fire(new AuthorWasStored($this));

        return $this;
    }

    public function edit($id, $name)
    {
        $author = $this::findOrFail($id);
        $author->name = $name;
        $author->save();

        Event::fire(new AuthorWasEdited($this));

        return $this;
    }
}
