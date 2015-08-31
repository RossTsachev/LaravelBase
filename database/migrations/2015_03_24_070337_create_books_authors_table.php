<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksAuthorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_authors', function (Blueprint $table) {
            $table -> increments('id');
            $table -> integer('book_id') -> unsigned();
            $table -> foreign('book_id') -> references('id') -> on('books');
            $table -> integer('author_id') -> unsigned();
            $table -> foreign('author_id') ->references('id') -> on('authors');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books_authors');
    }
}
