<?php

use App\Models\RoleProgramPermission;
use App\Models\Program;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
if (!function_exists('hasPermission')) {
    function hasPermission($programName, $permissionName)
    {
        $user = Auth::user();
        if (!$user) {
            return false;
        }

        // ดึงค่า program_id จากชื่อโปรแกรม
        $program = Program::where('name', $programName)->first();
        if (!$program) {
            return false;
        }

        // ดึงค่า permission_id จากชื่อสิทธิ์
        $permission = Permission::where('name', $permissionName)->first();
        if (!$permission) {
            return false;
        }

        // เปลี่ยนเป็น whereIn เพื่อรองรับหลาย role
        return RoleProgramPermission::whereIn('role_id', $user->roles->pluck('id')->toArray())
            ->where('program_id', $program->id)
            ->where('permission_id', $permission->id)
            ->exists();
    }
}

