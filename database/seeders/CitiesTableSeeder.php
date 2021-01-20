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
        	['id' => 1,'name' => 'Авсюнино','region_id' => 50,'slug' => 'avsyunino'],
        	['id' => 2,'name' => 'Андреевка','region_id' => 50,'slug' => 'andreevka'],
        	['id' => 3,'name' => 'Апрелевка','region_id' => 50,'slug' => 'aprelevka'],
        	['id' => 4,'name' => 'Архангельское','region_id' => 50,'slug' => 'arhangelskoe'],
        	['id' => 5,'name' => 'Ашукино','region_id' => 50,'slug' => 'ashukino'],
        	['id' => 6,'name' => 'Балашиха','region_id' => 50,'slug' => 'balashiha'],
        	['id' => 7,'name' => 'Барвиха','region_id' => 50,'slug' => 'barviha'],
        	['id' => 8,'name' => 'Белоозёрский','region_id' => 50,'slug' => 'beloozёrskiy'],
        	['id' => 9,'name' => 'Белоомут','region_id' => 50,'slug' => 'beloomut'],
        	['id' => 10,'name' => 'Биокомбината','region_id' => 50,'slug' => 'biokombinata'],
        ]);
    }
}
