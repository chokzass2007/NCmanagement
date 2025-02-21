<?php

namespace App\Http\Controllers\Permission;
use App\Models\User;
use App\Models\Role;
use App\Models\Program;
use App\Models\Permission;
use App\Models\RoleProgramPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

//use App\Models\Table;//เทเบิลที่ต้องการใช้

class PermissionRepository
{
    // Your repository logic here
    public function viewProgramA(Request $request)
    {
        // if ($user->hasPermission('ProgramA', $program)) {
        //     // แสดงโปรแกรม
        //     return view('programA');
        // } else {
        //     // ไม่อนุญาต
        //     abort(403);
        // }
    }

    public function editProgramB(Request $request)
    {
        $user = $request->user();
        $program = Program::where('name', 'ProgramB')->first();

        if ($user->hasPermission('edit_programname', $program)) {
            // แก้ไขโปรแกรม
            return view('editProgramB');
        } else {
            // ไม่อนุญาต
            abort(403);
        }
    }

    public function userHasPermission()
    {
        $user = Auth::user()->id; // ดึงข้อมูลผู้ใช้ที่ล็อกอิน
        dd($user);
                $programId = 1; // ID ของโปรแกรม Management (เปลี่ยนเป็นค่าจริง)
        $deletePermissionId = 3; // ID ของสิทธิ์ Delete (เปลี่ยนเป็นค่าจริง)
    
        // ตรวจสอบว่าผู้ใช้มีสิทธิ์ลบข้อมูลในโปรแกรมนี้หรือไม่
        $userHasPermission = RoleProgramPermission::where('role_id', $user->role_id)
            ->where('program_id', $programId)
            ->where('permission_id', $deletePermissionId)
            ->exists();
    
        return view('home', compact('userHasPermission'));
    }

   
}
