<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::rename('Permission_role_program_permission', 'Permission_role_program_permission');
        Schema::rename('Permission_permissions', 'Permission_permissions');
        Schema::rename('Permission_roles', 'Permission_roles');
        Schema::rename('Permission_user_roles', 'Permission_user_roles');
        Schema::rename('Permission_programs', 'Permission_programs');
    }

    public function down()
    {
        Schema::rename('Permission_role_program_permission', 'Permission_role_program_permission');
        Schema::rename('Permission_permissions', 'Permission_permissions');
        Schema::rename('Permission_roles', 'Permission_roles');
        Schema::rename('Permission_user_roles', 'Permission_user_roles');
        Schema::rename('Permission_programs', 'Permission_programs');
    }
};

