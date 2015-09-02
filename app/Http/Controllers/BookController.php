<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

use Illuminate\Http\Request;

use yajra\Datatables\Datatables;
use App\Book;
use App\Author;
use Session;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Collection;
use MyLibrary\Book\StoreBookCommand;
use MyLibrary\Book\UpdateBookCommand;

class BookController extends BaseController
{

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
        $books = Book::with('authors')->select(['books.id', 'books.title']);
        return Datatables::of($books)
            ->addColumn('authors', function ($book) {
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
                return $authorList;
            })
            ->addColumn('action', function ($book) {
                return '<a href = "'
                    . action('BookController@edit', [$book->id])
                    . '">Edit</a>';
            })
            ->filter(function ($query) use ($request) {
                
                if ($request['search']['value']) {
                    $query
                        ->join('author_book', 'author_book.book_id', '=', 'books.id')
                        ->join('authors', 'authors.id', '=', 'author_book.author_id')
                        ->where('authors.name', 'LIKE', '%' . $request['search']['value'] . '%')
                        ->orWhere('books.title', 'LIKE', '%' . $request['search']['value'] . '%');
                }
            })
            ->make(true);
    }

        public function show($id)
        {
            $book = Book::findOrFail($id);
            return view('books.show')->with('book', $book);
        }

        public function create()
        {
            $authors = Author::lists('name', 'id');
            return view('books.create')->with('authors', $authors);
        }

        public function store(BookRequest $request)
        {
            $input = $request->all();
            $authors = $request->input('author_list');

            $command = new StoreBookCommand($input['title'], $authors);
            $this->commandBus->execute($command);

            return redirect('books');
        }

        public function edit($id)
        {
            $book = Book::findOrFail($id);
            $authors = Author::lists('name', 'id');
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
            
            $command = new UpdateBookCommand($id, $input['title'], $authors);
            $this->commandBus->execute($command);

            return redirect('books');
        }
}
