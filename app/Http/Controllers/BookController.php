<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use MyLibrary\Book\Requests\BookRequest;

use MyLibrary\Book\Models\BookRepositoryInterface;
use MyLibrary\Author\Models\AuthorRepositoryInterface;
use MyLibrary\Book\Jobs\StoreBookJob;
use MyLibrary\Book\Jobs\UpdateBookJob;

//use Session;

class BookController extends Controller
{
    protected $book;
    protected $author;
    
    public function __construct(
        BookRepositoryInterface $book,
        AuthorRepositoryInterface $author
    ) {
        $this->book = $book;
        $this->author = $author;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('books.index');
    }

    public function getBooks(Request $request)
    {
        $result = $this->book->datatables($request);
        
        return $result;
    }

    public function show($id)
    {
        $book = $this->book->find($id);
        return view('books.show')->with('book', $book);
    }

    public function create()
    {
        $authors = $this->author->dropdown();
        return view('books.create')->with('authors', $authors);
    }

    public function store(BookRequest $request)
    {
        $input = $request->all();
        $authors = $request->input('author_list');
        $this->dispatch(new StoreBookJob($input['title'], $authors));

        return redirect('books');
    }

    public function edit($id)
    {
        $book = $this->book->find($id);
        $authors = $this->author->dropdown();
        $data = array(
            'book' => $book,
            'authors' => $authors
        );
        return view('books.edit')->with($data);
    }

    public function update($id, BookRequest $request)
    {
        $input = $request->all();
        $authors = $request->input('author_list');
        $this->dispatch(new UpdateBookJob($id, $input['title'], $authors));

        return redirect('books');
    }
}
