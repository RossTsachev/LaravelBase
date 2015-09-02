<?php

namespace MyLibrary\Post;

use Illuminate\Database\Eloquent\Model;
use MyLibrary\Eventing\EventGenerator;

class Post extends Model
{
    use EventGenerator;

    protected $fillable = [
        'comment'
    ];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function book()
    {
        return $this->belongsTo('\App\Book');
    }

    public function store($userId, $bookId, $post)
    {
        $this->user_id = $userId;
        $this->book_id = $bookId;
        $this->comment = $post;
        $this->save();

        $this->raise(new PostWasStored($this));

        return $this;
    }
}
