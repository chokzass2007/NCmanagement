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
        // dd( $user->roles->pluck('id'),$program->id,$permission->id);
// dd($user->id,$program->id,$permission->id);
        // ตรวจสอบสิทธิ์ของ role_id ว่ามีสิทธิ์ในโปรแกรมนี้หรือไม่
        return RoleProgramPermission::where('role_id',  $user->roles->pluck('id'))
            ->where('program_id', $program->id)
            ->where('permission_id', $permission->id)
            ->exists();
    }
}

