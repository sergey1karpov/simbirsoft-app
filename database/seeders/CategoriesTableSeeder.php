<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            // ['name' => 'Select a category', 'slug' => null],
        	['name' => 'Computers', 'slug' => 'computer-&-office', 'parent_slug' => null],
        	['name' => 'Cars and parts','slug' => 'cars-and-parts', 'parent_slug' => null],
        	['name' => 'Smartphones & Radio & Gps', 'slug' => 'smartphones-radio-gps', 'parent_slug' => null],
        	['name' => 'Games & Entertainment', 'slug' => 'games-&-entertainment', 'parent_slug' => null],
        	['name' => 'Photo & Video', 'slug' => 'photo-&-video', 'parent_slug' => null],

            ['name' => 'Monitors', 'slug' => 'monitors', 'parent_slug' => 'computer-&-office'],
            ['name' => 'Keyboards','slug' => 'keyboards', 'parent_slug' => 'computer-&-office'],
            ['name' => 'Computer mouses','slug' => 'computer-mouses', 'parent_slug' => 'computer-&-office'],

            ['name' => 'Cars', 'slug' => 'cars', 'parent_slug' => 'cars-and-parts'],
            ['name' => 'Trucks','slug' => 'trucks', 'parent_slug' => 'cars-and-parts'],
            ['name' => 'Busses','slug' => 'busses', 'parent_slug' => 'cars-and-parts'],
            ['name' => 'Accessoires','slug' => 'accessoires', 'parent_slug' => 'cars-and-parts'],
        ]);
    }
}
