<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = ['View', 'Delete', 'Editor'];
        foreach ($permissions as $permission) {
            DB::table('Permission_permissions')->insert([
                'name' => $permission,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
