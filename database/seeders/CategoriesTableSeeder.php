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
            ['name' => 'Select a category', 'slug' => null],
        	['name' => 'Computers', 'slug' => 'computer-&-office'],
        	['name' => 'Cars and parts','slug' => 'cars-and-parts'],
        	['name' => 'Smartphones & Radio & Gps', 'slug' => 'smartphones-radio-gps'],
        	['name' => 'Games & Entertainment', 'slug' => 'games-&-entertainment'],
        	['name' => 'Photo & Video', 'slug' => 'photo-&-video'],
        	['name' => 'Peoples', 'slug' => 'peoples'],
        	['name' => 'Work',  'slug' => 'work'],
        	['name' => 'Animals', 'slug' => 'animals'],
        	['name' => 'Bussines', 'slug' => 'bussines'],
        ]);
    }
}
