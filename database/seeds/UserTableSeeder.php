<?php

use Illuminate\Database\Seeder;
use Faker\Generator;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory('App\User', 50)->create();

    }
}
