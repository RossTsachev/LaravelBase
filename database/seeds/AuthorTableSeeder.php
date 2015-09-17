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
        factory('MyLibrary\Author\Models\Author', 100)
            ->create()
            ->each(function ($u) {
                $u->books()->save(factory(MyLibrary\Book\Models\Book::class)->make());
            });
    }
}
