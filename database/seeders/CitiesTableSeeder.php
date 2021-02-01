<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
        	['name' => 'Авсюнино','region_id' => 1,'slug' => 'avsyunino', 'region_slug' => 'moscow-oblast'],
        	['name' => 'Андреевка','region_id' => 1,'slug' => 'andreevka', 'region_slug' => 'moscow-oblast'],
        	['name' => 'Апрелевка','region_id' => 1,'slug' => 'aprelevka', 'region_slug' => 'moscow-oblast'],
        	['name' => 'Архангельское','region_id' => 1,'slug' => 'arhangelskoe', 'region_slug' => 'moscow-oblast'],
        	['name' => 'Ашукино','region_id' => 1,'slug' => 'ashukino', 'region_slug' => 'moscow-oblast'],
        	['name' => 'Балашиха','region_id' => 1,'slug' => 'balashiha', 'region_slug' => 'moscow-oblast'],
        	['name' => 'Барвиха','region_id' => 1,'slug' => 'barviha', 'region_slug' => 'moscow-oblast'],
        	['name' => 'Белоозёрский','region_id' => 1,'slug' => 'beloozёrskiy', 'region_slug' => 'moscow-oblast'],
        	['name' => 'Белоомут','region_id' => 1,'slug' => 'beloomut', 'region_slug' => 'moscow-oblast'],
        	['name' => 'Биокомбината','region_id' => 1,'slug' => 'biokombinata', 'region_slug' => 'moscow-oblast'],
            ['name' => 'Ulyanovsk','region_id' => 2,'slug' => 'ulyanovsk', 'region_slug' => 'ulyanovsk-oblast'],
        ]);
    }
}
