<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
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
        //\App\Models\User::factory(5)->create();
        
        //Product::factory(15)->create();

        Tag::factory(10)->create();

        //$this->call(CategoriesTableSeeder::class);
    }
}
