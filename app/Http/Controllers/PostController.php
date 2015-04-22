<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use App\Post;
use Session;

class PostController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($books, Requests\PostRequest $request)
	{
		$post = new Post;
		$post->comment = $request->comment; 
		$userId = Auth::user()->id;
		$post->user_id = $userId;
		$post->book_id = $books;
		$post->save();
		Session::flash('flash-message', 'The post was saved.');
		return redirect($request->url());
	}

}
