<?php

Route::get('/', function () {
    return view('auth/login');
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::resource('books', 'BookController');
Route::resource('authors', 'AuthorController');

//set default home link
Route::get('/home', 'BookController@index');

//comments for a book
Route::post('books/{books}', 'PostController@store');

//Ajax
Route::get('/book/getBooks', 'BookController@getBooks');
Route::get('/author/getAuthors', 'AuthorController@getAuthors');
