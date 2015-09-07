<?php

namespace MyLibrary\Author\Models;

use Illuminate\Database\Eloquent\Model;

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
}
