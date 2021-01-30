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
        	['name' => 'Авсюнино','region_id' => 50,'slug' => 'avsyunino'],
        	['name' => 'Андреевка','region_id' => 50,'slug' => 'andreevka'],
        	['name' => 'Апрелевка','region_id' => 50,'slug' => 'aprelevka'],
        	['name' => 'Архангельское','region_id' => 50,'slug' => 'arhangelskoe'],
        	['name' => 'Ашукино','region_id' => 50,'slug' => 'ashukino'],
        	['name' => 'Балашиха','region_id' => 50,'slug' => 'balashiha'],
        	['name' => 'Барвиха','region_id' => 50,'slug' => 'barviha'],
        	['name' => 'Белоозёрский','region_id' => 50,'slug' => 'beloozёrskiy'],
        	['name' => 'Белоомут','region_id' => 50,'slug' => 'beloomut'],
        	['name' => 'Биокомбината','region_id' => 50,'slug' => 'biokombinata'],
        ]);
    }
}
