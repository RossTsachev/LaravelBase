<?php

namespace MyLibrary\Post\Models;

use Event;
use Illuminate\Database\Eloquent\Model;

use MyLibrary\Post\Events\PostWasStored;

class Post extends Model
{
    protected $fillable = [
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function book()
    {
        return $this->belongsTo('MyLibrary\Book\Models\Book');
    }

    public function store($userId, $bookId, $post)
    {
        $this->user_id = $userId;
        $this->book_id = $bookId;
        $this->comment = $post;
        $this->save();

        Event::fire(new PostWasStored($this));

        return $this;
    }
}
