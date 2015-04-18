<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

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

}
