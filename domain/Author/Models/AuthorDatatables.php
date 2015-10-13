<?php

namespace MyLibrary\Author\Models;

use yajra\Datatables\Datatables;
use MyLibrary\Author\Models\Author;

class AuthorDatatables
{
    private function showBooksRow($author)
    {
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
    }

    private function showActionsRow($author)
    {
        return
           '<a href = "'
           . action('AuthorController@show', [$author->id])
           . '">View</a> | '
           . '<a href = "'
           . action('AuthorController@edit', [$author->id])
           . '">Edit</a>';
    }

    private function customFilter($query, $request)
    {
        if ($request['search']['value']) {
            $query
                ->join('author_book', 'author_book.author_id', '=', 'authors.id')
                ->join('books', 'books.id', '=', 'author_book.book_id')
                ->where('authors.name', 'LIKE', '%' . $request['search']['value'] . '%')
                ->orWhere('books.title', 'LIKE', '%' . $request['search']['value'] . '%');
        }
    }

    public function datatables($request)
    {
        $authors = Author::with('books')->select(['authors.id', 'authors.name']);

        $result = Datatables::of($authors)
            ->addColumn('books', function ($author) {
                return $this->showBooksRow($author);
            })
            ->addColumn('action', function ($author) {
                return $this->showActionsRow($author);
            })
            ->filter(function ($query) use ($request) {
                $this->customFilter($query, $request);
            })
            ->make(true);

        return $result;
    }
}
