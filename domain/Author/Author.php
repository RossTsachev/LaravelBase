<?php

namespace MyLibrary\Author;

use Illuminate\Database\Eloquent\Model;
use MyLibrary\Eventing\EventGenerator;

class Author extends Model
{
    use EventGenerator;

    protected $fillable = [
        'name'
    ];

    public function books()
    {
        return $this
            ->belongsToMany('\App\Book')
            ->withTimestamps()
            ->select(['books.id', 'books.title']);
    }

    public function store($name)
    {
        $this->name = $name;
        $this->save();

        $this->raise(new AuthorWasStored($this));

        return $this;
    }

    public function edit($id, $name)
    {
        $author = $this::findOrFail($id);
        $author->name = $name;
        $author->save();

        $this->raise(new AuthorWasEdited($this));

        return $this;
    }
}
