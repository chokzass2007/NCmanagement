<?php

namespace App\Http\Controllers\Permission;
use App\Models\User;
use App\Models\Role;
use App\Models\Program;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use App\Models\Table;//เทเบิลที่ต้องการใช้

class PermissionRepository
{
    // Your repository logic here
    public function viewProgramA(Request $request)
    {
        $user = $request->user();
        $program = Program::where('name', 'ProgramA')->first();
// dd($program);
        if ($user->hasPermission('ProgramA', $program)) {
            // แสดงโปรแกรม
            return view('programA');
        } else {
            // ไม่อนุญาต
            abort(403);
        }
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



   
}
