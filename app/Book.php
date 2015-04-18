<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

	protected $fillable = [
		'title'
	];

	public function posts()
	{
		return $this->hasMany('\App\Post');
	}

	public function authors() 
	{
		return $this->belongsToMany('\App\Author')->withTimestamps();
	}

	public function getAuthorListAttribute()
	{
		return $this->authors->lists('id');
	}

}
