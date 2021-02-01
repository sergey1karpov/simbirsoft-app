<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
        	['name' => 'Moscow Oblast', 'slug' => 'moscow-oblast'],
            ['name' => 'Ulyanovsk Oblast', 'slug' => 'ulyanovsk-oblast'],
        ]);
    }
}
