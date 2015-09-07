<?php

namespace MyLibrary\Author\Models;

use yajra\Datatables\Datatables;

use MyLibrary\Author\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function find($id)
    {
        return Author::findOrFail($id);
    }

    public function dropdown()
    {
        return Author::lists('name', 'id')->take(5);
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
