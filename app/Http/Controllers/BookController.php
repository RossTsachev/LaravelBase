<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BookController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$books = \App\Book::all();
		return view('books.index')->with('books', $books);
	}

	public function show($id)
	{
		$book = \App\Book::findOrFail($id);
		return view('books.show')->with('book', $book);
	}

	public function create()
	{
		$authors = \App\Author::lists('name','id');	
		return view('books.create')->with('authors', $authors);
	}

	public function store(Requests\BookRequest $request)
	{
		$input = $request->all();
		$book = \App\Book::create($input);
		$authors = $request->input('author_list');
		$book->authors()->sync($authors);
		return redirect('books');
	}

	public function edit($id)
	{
		$book = \App\Book::findOrFail($id);
		$authors = \App\Author::lists('name','id');
		$data = array(
			'book' => $book,
			'authors' => $authors
		);
		return view('books.edit')->with($data);
	}

	public function update($id, Requests\BookRequest $request)
	{
		$book = \App\Book::findOrFail($id);
		$book->update($request->all());
		$authors = $request->input('author_list');
		$book->authors()->sync($authors);
		return redirect('books');
	}
}
