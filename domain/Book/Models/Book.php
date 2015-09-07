<?php

namespace MyLibrary\Book\Models;

use Illuminate\Database\Eloquent\Model;

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
}
