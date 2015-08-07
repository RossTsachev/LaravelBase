<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use yajra\Datatables\Datatables;
use App\Book;
use App\Author;
use Session;
use Illuminate\Support\Collection;

class BookController extends Controller {

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
		$books = Book::all();
		return view('books.index')->with('books', $books);
	}

	public function getBooks()
	{
		$books = Book::all();
		$result = new Collection();

		foreach ($books as $book) {
			$authorList = '';
			foreach ($book->authors as $author) {
				$comma = $authorList ? ', ' : '';
				$authorList .= $comma
					. '<a href="'
					. action('AuthorController@show', [$author->id])
					. '">'
					. $author->name
					. '</a>';
			}
			$result->push([
				'id' => $book->id,
				'title' => '<a href="'
					. action('BookController@show', [$book->id])
					. '">'
					. $book->title
					. '</a>',
				'authors' => $authorList,	
				'action' => '<a href="'
					.action('BookController@edit', [$book->id])
					. '">Edit</a>'
			]);
		}

		return Datatables::of($result)->make(true);
	}

	public function show($id)
	{
		$book = Book::findOrFail($id);
		return view('books.show')->with('book', $book);
	}

	public function create()
	{
		$authors = Author::lists('name','id');	
		return view('books.create')->with('authors', $authors);
	}

	public function store(Requests\BookRequest $request)
	{
		$input = $request->all();
		$book = Book::create($input);
		$authors = $request->input('author_list');
		$book->authors()->sync($authors);
		Session::flash('flash-message', 'The book was saved.');
		return redirect('books');
	}

	public function edit($id)
	{
		$book = Book::findOrFail($id);
		$authors = Author::lists('name','id');
		$data = array(
			'book' => $book,
			'authors' => $authors
		);
		return view('books.edit')->with($data);
	}

	public function update($id, Requests\BookRequest $request)
	{
		$book = Book::findOrFail($id);
		$book->update($request->all());
		$authors = $request->input('author_list');
		$book->authors()->sync($authors);
		Session::flash('flash-message', 'The book was edited.');
		return redirect('books');
	}
}
