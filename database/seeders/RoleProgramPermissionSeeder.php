<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleProgramPermissionSeeder extends Seeder
{
    public function run()
    {
        $Permission = [1,2,3];
        foreach($Permission as $item){
            DB::table('Permission_role_program_permission')->insert([
                'role_id' => 1, // Admin
                'program_id' => 1, // Management
                'Permission_id' => $item, // View
                'user_id' => 1, // ผู้ใช้ที่มีสิทธิ์
                'created_at' => now(),
                'updated_at' => now()
            ]);

        }
    }
}
