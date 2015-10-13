<?php

namespace MyLibrary\Book\Models;

use yajra\Datatables\Datatables;
use MyLibrary\Book\Models\Book;

class BookDatatables
{
    private function showAuthorsRow($book)
    {
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
    }

    private function showActionsRow($book)
    {
        return
            '<a href = "'
            . action('BookController@show', [$book->id])
            . '">View</a> | '
            . '<a href = "'
            . action('BookController@edit', [$book->id])
            . '">Edit</a>';
    }

    private function customFilter($query, $request)
    {
        if ($request['search']['value']) {
            $query
                ->join('author_book', 'author_book.book_id', '=', 'books.id')
                ->join('authors', 'authors.id', '=', 'author_book.author_id')
                ->where('authors.name', 'LIKE', '%' . $request['search']['value'] . '%')
                ->orWhere('books.title', 'LIKE', '%' . $request['search']['value'] . '%');
        }
    }

    public function datatables($request)
    {
        $books = Book::with('authors')->select(['books.id', 'books.title']);
        
        $result =  Datatables::of($books)
            ->addColumn('authors', function ($book) {
                return $this->showAuthorsRow($book);
            })
            ->addColumn('action', function ($book) {
                return $this->showActionsRow($book);
            })
            ->filter(function ($query) use ($request) {
                $this->customFilter($query, $request);
            })
            ->make(true);

        return $result;
    }
}
