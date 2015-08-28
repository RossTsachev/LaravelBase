<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

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

    public function getAuthorListAttribute()
    {
        return $this->authors->lists('id');
    }
}
