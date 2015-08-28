<?php

namespace app\Http\Controllers;

use App\Author;
use App\Http\Requests;
use Illuminate\Support\Collection;
use Session;
use yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
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
        return view('authors.index');
    }

    /**
     * Displays json for all the authors.
     *
     * @return json
     */
    public function getAuthors(Request $request)
    {
        $authors = Author::with('books')->select(['authors.id', 'authors.name']);

        return Datatables::of($authors)
            ->addColumn('books', function ($author) {
                $bookList = '';
                foreach ($author->books as $book) {
                    $comma = $bookList ? ', ' : '';
                    $bookList .= $comma
                    .'<a href="'
                    .action('BookController@show', [$book->id])
                    .'">'
                    .$book->title
                    .'</a>';
                }
                return $bookList;
            })
            ->addColumn('action', function ($author) {
                return '<a href = "'
                    . action('AuthorController@edit', [$author->id])
                    . '">Edit</a>';
            })
            ->filter(function ($query) use ($request) {
                
                if ($request['search']['value']) {
                    $query
                        ->join('author_book', 'author_book.author_id', '=', 'authors.id')
                        ->join('books', 'books.id', '=', 'author_book.book_id')
                        ->where('authors.name', 'LIKE', '%' . $request['search']['value'] . '%')
                        ->orWhere('books.title', 'LIKE', '%' . $request['search']['value'] . '%');
                }
            })
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
     * @param int $id
     *
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
     * @param int $id
     *
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
     * @param int $id
     *
     * @return Response
     */
    public function update($id, Requests\AuthorRequest $request)
    {
        $author = Author::findOrFail($id);
        $author->update(
            $request->all()
        );
        Session::flash('flash-message', 'The author was updated.');

        return redirect('authors');
    }
}
