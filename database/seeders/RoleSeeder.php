<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['Admin', 'Manager', 'Employee', 'Guest'];
        foreach ($roles as $role) {
            DB::table('Permission_roles')->insert([
                'name' => $role,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
