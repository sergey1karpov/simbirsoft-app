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
        	['id' => 1,'name' => 'Республика Адыгея (Адыгея)'],
        	['id' => 2,'name' => 'Республика Башкортостан'],
        	['id' => 3,'name' => 'Республика Бурятия'],
        	['id' => 4,'name' => 'Республика Алтай'],
        	['id' => 5,'name' => 'Республика Дагестан'],
        	['id' => 6,'name' => 'Республика Ингушетия'],
        	['id' => 7,'name' => 'Кабардино-Балкарская Республика'],
        	['id' => 8,'name' => 'Республика Калмыкия'],
        	['id' => 9,'name' => 'Карачаево-Черкесская Республика'],
        	['id' => 10,'name' => 'Республика Карелия'],
        ]);
    }
}
