<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // factory('App\User', 500)->create();
        //factory('App\Address', 1000)->create();
        //factory('App\Product', 1500)->create();
        //factory('App\Image', 100)->create();
        factory('App\Image', 3500)->create();
        //factory('App\Review', 3500)->create();
        //factory('App\Category', 50)->create();
        //factory('App\Tag', 150)->create();
        // factory('App\Ticket', 150)->create();
        // factory('App\Unit', 100)->create();

    }
}
