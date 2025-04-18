<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        DB::table('Permission_programs')->insert([
            'name' => 'RoleManagement',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
