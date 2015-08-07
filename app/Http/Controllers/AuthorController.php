<?php namespace App\Http\Controllers;

use yajra\Datatables\Datatables;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Author;
use Session;

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

	public function getAuthors()
	{
		$authors = Author::select(['id', 'name']);

        return Datatables::of($authors)
        	->editColumn(
        		'name',
        		'<a href="{{action(\'AuthorController@show\', [$id])}}">{{ $name }}</a>'
        	)
			->editColumn(
				'action',
				'<a href="{{action(\'AuthorController@edit\', [$id])}}">Edit</a>'
			)
        	->make(true);
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
