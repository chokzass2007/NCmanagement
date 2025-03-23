<?php

namespace App\Http\Controllers\Management;

use App\Models\User;
use App\Models\Role;
use App\Models\Program;
use App\Models\Permission;
use App\Models\RoleProgramPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\Models\Table;//เทเบิลที่ต้องการใช้

class ProgramRepository
{

    public function main()
    {
        $users = User::all();
        $roles = Role::all();
        $programs = Program::all();
        $permissions = Permission::all();

        return view('admin.Management', compact('roles', 'programs', 'permissions', 'users'));
    }
    public function ManageProgram()
    {
        $results = User::leftJoin('Permission_role_program_permission', 'users.id', '=', 'Permission_role_program_permission.user_id')
        ->rightJoin('Permission_permissions', 'Permission_role_program_permission.Permission_id', '=', 'Permission_permissions.id')
        ->leftJoin('Permission_programs', 'Permission_role_program_permission.program_id', '=', 'Permission_programs.id')
        ->join('Permission_roles', 'Permission_role_program_permission.role_id', '=', 'Permission_roles.id')
        ->where('Permission_role_program_permission.user_id', '!=', 1)
        ->select(
            'Permission_role_program_permission.id',
            'Permission_programs.name as Program',
            'Permission_permissions.name as permission',
            'users.name',
            'Permission_roles.name as Expr1'
        )
        ->get();
    


        return view('admin.ManageProgram', compact('results'));
    }
    public function program()
    {
        $programs = Program::all()->where('id', '!=', 1);
        return view('admin.Program', compact('programs'));
    }
    public function permission()
    {
        $permission = Permission::all()->where('id', '!=', 1);
        return view('admin.permission', compact('permission'));
    }
    public function role()
    {
        $role = Role::all();
        return view('admin.role', compact('role'));
    }
    // Your repository logic here
    public function storePermission(Request $request)
    {
        $userId = $request->user_id;
        $roleId = $request->role_id;
        $programId = $request->program_id;
        $permissionIds = $request->permissions;

        // ลบสิทธิ์เก่าก่อน แล้วเพิ่มสิทธิ์ใหม่
        DB::table('Permission_role_program_permission')
            ->where('role_id', $roleId)
            ->where('program_id', $programId)
            ->where('user_id', $userId)
            ->delete();

        foreach ($permissionIds as $permissionId) {
            DB::table('Permission_role_program_permission')->insert([
                'user_id' => $userId,
                'role_id' => $roleId,
                'program_id' => $programId,
                'Permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Permissions assigned successfully!');
    }

    public function store(Request $request)
    {
        Program::updateOrCreate(['id' => $request->id], ['name' => $request->name]);
        return redirect()->back()->with('success', 'Program saved!');
    }
    public function storePrograms(Request $request)
    {
        Program::updateOrCreate(['id' => $request->id], ['name' => $request->name]);
        return redirect()->back()->with('success', 'Program saved!');
    }
    public function storePermissions(Request $request)
    {
        Permission::updateOrCreate(['id' => $request->id], ['name' => $request->name]);
        return redirect()->back()->with('success', 'Program saved!');
    }
    public function storeRole(Request $request)
    {
        Role::updateOrCreate(['id' => $request->id], ['name' => $request->name]);
        return redirect()->back()->with('success', 'Role saved!');
    }
    public function ManagementStore(Request $request)
    {
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'role_id'      => 'required|exists:Permission_roles,id',
            'program_id'   => 'required|exists:Permission_programs,id',
            'permissions'  => 'required|array',
            'permissions.*' => 'exists:Permission_permissions,id',
        ]);

        // dd($request->all());
        // ดึงค่าจาก request
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');
        $programId = $request->input('program_id');
        $permissions = $request->input('permissions'); // อาร์เรย์ของ Permission_id

        // ✅ **เช็คว่า user มี role นี้ใน user_roles แล้วหรือยัง**
        $user = User::find($userId);
        if (!$user->roles()->where('role_id', $roleId)->exists()) {
            $user->roles()->attach($roleId);
        }

        // ✅ **เช็คว่า role มีสิทธิ์ในโปรแกรมนี้หรือยัง**
        foreach ($permissions as $permissionId) {
            $exists = RoleProgramPermission::where('role_id', $roleId)
                ->where('program_id', $programId)
                ->where('Permission_id', $permissionId)
                ->exists();
            // dd($userId, $roleId, $programId, $permissionId);
            if (!$exists) {
                RoleProgramPermission::create([
                    'user_id' => $userId,
                    'role_id' => $roleId,
                    'program_id' => $programId,
                    'Permission_id' => $permissionId,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Permissions updated successfully!');
    }

    public function destroyProgram($id)
    {
        Program::find($id)->delete();
        return redirect()->back()->with('success', 'Program deleted!');
    }
    public function destroyPermission($id)
    {
        Permission::find($id)->delete();
        return redirect()->back()->with('success', 'Program deleted!');
    }
    public function destroyRole($id)
    {
        Role::find($id)->delete();
        return redirect()->back()->with('success', 'Program deleted!');
    }
    public function removePermission(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:Permission_role_program_permission,id',
        ]);

        DB::table('Permission_role_program_permission')->where('id', $request->id)->delete();

        return redirect()->back()->with('success', 'Permission removed successfully!');
    }
    public function removeRole(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:Permission_role_program_permission,id',
        ]);

        DB::table('Permission_roles')->where('id', $request->id)->delete();

        return redirect()->back()->with('success', 'Permission removed successfully!');
    }
}
