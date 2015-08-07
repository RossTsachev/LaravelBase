<?php namespace App\Http\Controllers;

use yajra\Datatables\Datatables;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Author;
use Session;
use Illuminate\Support\Collection;

class AuthorController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$authors = Author::latest()->get();
		return view('authors.index')->with('authors', $authors);
	}

	/**
	 * Displays json for all the authors
	 * @return json
	 */
	public function getAuthors()
	{
		$authors = Author::all();
		$result = new Collection;

		foreach ($authors as $author) {
			$bookList = '';
			foreach ($author->books as $book) {
				$comma = $bookList ? ', ' : '';
				$bookList .= $comma
					. '<a href="'
					. action('BookController@show', [$book->id])
					. '">'
					. $book->title
					. '</a>';
			}
			$result->push([
				'id' => $author->id,
				'name' => '<a href="'
					. action('AuthorController@show', [$author->id])
					. '">'
					. $author->name
					. '</a>',
				'books' => $bookList,	
				'action' => '<a href="'
					. action('AuthorController@edit', [$author->id])
					. '">Edit</a>'
			]);
		}

		return Datatables::of($result)->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('authors.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\AuthorRequest $request)
	{
		 $input = $request->all();
		 Author::create($input);
		 Session::flash('flash-message', 'The author was saved.');
		 return redirect('authors');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$author = Author::findOrFail($id);
		return view('authors.show')->with('author', $author);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$author = Author::findOrFail($id);
		return view('authors.edit')->with('author', $author);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Requests\AuthorRequest $request)
	{
		$author = Author::findOrFail($id);
		$author->update($request->all());
		Session::flash('flash-message', 'The author was updated.');
		return redirect('authors');
	}
}
