<?php

namespace MyLibrary\Book;

use Illuminate\Database\Eloquent\Model;
use MyLibrary\Eventing\EventGenerator;

class Book extends Model
{
    use EventGenerator;

    protected $fillable = [
        'title'
    ];

    public function posts()
    {
        return $this->hasMany('\App\Post')->orderBy('created_at', 'desc');
    }

    public function authors()
    {
        return $this
            ->belongsToMany('\App\Author')
            ->withTimestamps()
            ->select(['authors.id', 'authors.name']);
    }

    public function store($title, $authors)
    {
        $this->title = $title;
        $this->save();
        $this->authors()->sync($authors);

        $this->raise(new BookWasStored($this));

        return $this;
    }

    public function edit($id, $title, $authors)
    {
        $book = $this::findOrFail($id);
        $book->title = $title;
        $book->save();

        $book->authors()->sync($authors);

        $this->raise(new BookWasEdited($this));

        return $this;
    }
}
