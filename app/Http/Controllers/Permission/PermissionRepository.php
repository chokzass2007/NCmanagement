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

    public function indexx()
    {
        $roles = Role::all();
        $programs = Program::all();
        $permissions = Permission::all();

        return view('ProgramA', compact('roles', 'programs', 'permissions'));
    }

    public function storee(Request $request)
    {
        $roleId = $request->role_id;
        $programId = $request->program_id;
        $permissionIds = $request->permissions;

        foreach ($permissionIds as $permissionId) {
            DB::table('role_program_permission')->insert([
                'role_id' => $roleId,
                'program_id' => $programId,
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Permissions assigned successfully!');
    }
}
