<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        DB::table('Permission_user_roles')->insert([
            'user_id' => 1, // ผู้ดูแลระบบ
            'role_id' => 1, // Admin
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
