<?php

use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Author', 1000)
            ->create()
            ->each(function ($u) {
                $u->books()->save(factory(App\Book::class)->make());
            });
    }
}