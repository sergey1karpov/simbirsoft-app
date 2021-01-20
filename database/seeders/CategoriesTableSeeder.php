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
        	['id' => 1,'name' => 'Games', 'parent_id' => null, 'slug' => 'games'],
        	['id' => 2,'name' => 'Sony Playstation', 'parent_id' => 1, 'slug' => 'playstation'],
        	['id' => 3,'name' => 'Consoles PS', 'parent_id' => 2, 'slug' => 'psconsole'],
        	['id' => 4,'name' => 'Sony Playstation 4', 'parent_id' => 3, 'slug' => 'ps4'],
        	['id' => 5,'name' => 'Sony Playstation 5', 'parent_id' => 3, 'slug' => 'ps5'],
        	['id' => 6,'name' => 'Disks(Playstation)', 'parent_id' => 2, 'slug' => 'psgames'],
        	['id' => 7,'name' => 'Games for PS4', 'parent_id' => 6, 'slug' => 'ps4games'],
        	['id' => 8,'name' => 'Games for PS5', 'parent_id' => 6, 'slug' => 'ps5games'],
        	['id' => 9,'name' => 'Accessoires', 'parent_id' => 2, 'slug' => 'psaccessoires'],
        	['id' => 10,'name' => 'Gamepads(PS4)', 'parent_id' => 9, 'slug' => 'ps4gamepads'],
        	['id' => 11,'name' => 'Gamepads(PS5)', 'parent_id' => 9, 'slug' => 'ps5gamepads'],
        	['id' => 12,'name' => 'Sony Headphones', 'parent_id' => 9, 'slug' => 'psheadphones'],
        	['id' => 13,'name' => 'Sony Playstation VR', 'parent_id' => 9, 'slug' => 'psvr'],
        	['id' => 14,'name' => 'Playstation Camera', 'parent_id' => 9, 'slug' => 'pscamera'],
        	['id' => 15,'name' => 'XBOX', 'parent_id' => 1, 'slug' => 'xbox'],
        	['id' => 16,'name' => 'Consoles XBOX', 'parent_id' => 15, 'slug' => 'xboxconsole'],
        	['id' => 17,'name' => 'XBOX One', 'parent_id' => 16, 'slug' => 'xboxone'],
        	['id' => 18,'name' => 'XBOX Series S', 'parent_id' => 16, 'slug' => 'seriess'],
        	['id' => 19,'name' => 'XBOX Series X', 'parent_id' => 16, 'slug' => 'seriesx'],
        	['id' => 20,'name' => 'Disks(XBOX)', 'parent_id' => 15, 'slug' => 'xboxgames'],
        	['id' => 21,'name' => 'Accessoires', 'parent_id' => 15, 'slug' => 'xboxaccessoires'],
        	['id' => 22,'name' => 'Gamepads(XBOX)', 'parent_id' => 21, 'slug' => 'xboxgamepads'],
        	['id' => 23,'name' => 'SSD(XBOX)', 'parent_id' => 21, 'slug' => 'ssdxbox'],
        	['id' => 24,'name' => 'Nintendo', 'parent_id' => 1, 'slug' => 'nintendo'],
        	['id' => 25,'name' => 'Consoles(Nintendo)', 'parent_id' => 24, 'slug' => 'ninconsole'],
        	['id' => 26,'name' => 'Games(Nintendo)', 'parent_id' => 24, 'slug' => 'ningames'],
        ]);
    }
}
