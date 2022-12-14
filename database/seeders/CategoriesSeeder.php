<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Horror', 'Thriller', 'Romance', 'Action', 'Fantasy', 'Comedy', 'Adventure', 'Drama'];

        foreach ($categories as $category)
        {
            \App\Models\Category::insert([
                [
                    'name' => $category,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }
    }
}
