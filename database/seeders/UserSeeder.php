<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ผู้ดูแลระบบ NC',
            'email' => 'admin@system.com',
            'password' => Hash::make('123456'), // รหัสผ่านเข้ารหัส
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
