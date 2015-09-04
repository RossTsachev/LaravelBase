<?php

namespace MyLibrary\Book\Models;

use Event;
use Illuminate\Database\Eloquent\Model;

use MyLibrary\Book\Events\BookWasStored;
use MyLibrary\Book\Events\BookWasEdited;

class Book extends Model
{
    protected $fillable = [
        'title'
    ];

    public function posts()
    {
        return $this->hasMany('MyLibrary\Post\Models\Post')->orderBy('created_at', 'desc');
    }

    public function authors()
    {
        return $this
            ->belongsToMany('\MyLibrary\Author\Models\Author')
            ->withTimestamps()
            ->select(['authors.id', 'authors.name']);
    }

    public function store($title, $authors)
    {
        $this->title = $title;
        $this->save();
        $this->authors()->sync($authors);

        Event::fire(new BookWasStored($this));

        return $this;
    }

    public function edit($id, $title, $authors)
    {
        $book = $this::findOrFail($id);
        $book->title = $title;
        $book->save();

        $book->authors()->sync($authors);

        Event::fire(new BookWasEdited($this));

        return $this;
    }
}
