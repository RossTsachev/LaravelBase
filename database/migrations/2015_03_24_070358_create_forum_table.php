<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forum', function(Blueprint $table){
			$table -> increments('id');
			$table -> integer('user_id') -> unsigned();
			$table -> foreign('user_id') -> references('id') -> on('users');
			$table -> integer('book_id') -> unsigned();
			$table -> foreign('book_id') -> references('id') -> on('books');
			$table -> text('comment');
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
		Schema::drop('forum');
	}

}
