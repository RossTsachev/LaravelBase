<?php

namespace MyLibrary\Book\Models;

use yajra\Datatables\Datatables;

use MyLibrary\Book\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    public function find($id)
    {
        return Book::findOrFail($id);
    }

    public function datatables($request)
    {
        $books = Book::with('authors')->select(['books.id', 'books.title']);
        
        $result =  Datatables::of($books)
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

        return $result;
    }
}
