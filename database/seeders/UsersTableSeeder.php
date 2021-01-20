<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	['id' => 999,'name' => 'Admin','email' => 'admin@admin.com','password' => Hash::make('q1w2e3r4'), 'telephone' => 02, 'role' => 'Admin', 'status' => 'Active'],
        ]);
    }
}
