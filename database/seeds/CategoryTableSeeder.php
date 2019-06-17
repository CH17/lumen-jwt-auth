<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  factory(App\Category::class, 'parent', 5)->create();
        factory(App\Category::class, 10)->create();
        
    }
}
