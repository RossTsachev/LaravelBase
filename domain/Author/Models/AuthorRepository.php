<?php

namespace MyLibrary\Author\Models;

use Event;
use yajra\Datatables\Datatables;

use MyLibrary\Author\Models\Author;

use MyLibrary\Author\Events\AuthorWasStored;
use MyLibrary\Author\Events\AuthorWasEdited;

class AuthorRepository implements AuthorRepositoryInterface
{
    public $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    // to check if this is valid
    public function books()
    {
        return $this
            ->author
            ->belongsToMany('MyLibrary\Book\Models\Book')
            ->withTimestamps()
            ->select(['books.id', 'books.title']);
    }

    public function find($id)
    {
        return Author::findOrFail($id);
    }

    public function dropdown()
    {
        return Author::lists('name', 'id')->take(5);
    }

    public function store($name)
    {
        $this->author->name = $name;
        $this->author->save();
        Event::fire(new AuthorWasStored($this));
        return $this->author;
    }

    public function edit($id, $name)
    {
        $this->author = $this->find($id);
        $this->author->name = $name;
        $this->author->save();
        Event::fire(new AuthorWasEdited($this));
        return $this->author;
    }

    public function datatables($request)
    {
        $authors = Author::with('books')->select(['authors.id', 'authors.name']);

        $result = Datatables::of($authors)
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

        return $result;
    }
}
