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
        $permissions = DB::table('role_program_permission as rpp')
            ->join('roles', 'rpp.role_id', '=', 'roles.id')
            ->join('programs', 'rpp.program_id', '=', 'programs.id')
            ->join('permissions', 'rpp.permission_id', '=', 'permissions.id')
            ->join('user_roles', 'rpp.role_id', '=', 'user_roles.role_id')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->select(
                'rpp.id',
                'users.name as user_name',
                'roles.name as role_name',
                'programs.name as program_name',
                'permissions.name as permission_name'
            )
            ->orderBy('users.name')
            ->get();


        return view('admin.ManageProgram', compact('permissions'));
    }
    public function program()
    {
        $programs = Program::all();
        return view('admin.Program', compact('programs'));
    }
    public function permission()
    {
        $permission = Permission::all();
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
        DB::table('role_program_permission')
            ->where('role_id', $roleId)
            ->where('program_id', $programId)
            ->where('user_id', $userId)
            ->delete();

        foreach ($permissionIds as $permissionId) {
            DB::table('role_program_permission')->insert([
                'user_id' => $userId,
                'role_id' => $roleId,
                'program_id' => $programId,
                'permission_id' => $permissionId,
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
            'role_id'      => 'required|exists:roles,id',
            'program_id'   => 'required|exists:programs,id',
            'permissions'  => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // ดึงค่าจาก request
        $userId = $request->input('user_id');
        $roleId = $request->input('role_id');
        $programId = $request->input('program_id');
        $permissions = $request->input('permissions'); // อาร์เรย์ของ permission_id

        // ✅ **เช็คว่า user มี role นี้ใน user_roles แล้วหรือยัง**
        $user = User::find($userId);
        if (!$user->roles()->where('role_id', $roleId)->exists()) {
            $user->roles()->attach($roleId);
        }

        // ✅ **เช็คว่า role มีสิทธิ์ในโปรแกรมนี้หรือยัง**
        foreach ($permissions as $permissionId) {
            $exists = RoleProgramPermission::where('role_id', $roleId)
                ->where('program_id', $programId)
                ->where('permission_id', $permissionId)
                ->exists();
            // dd($userId, $roleId, $programId, $permissionId);
            if (!$exists) {
                RoleProgramPermission::create([
                    'user_id' => $userId,
                    'role_id' => $roleId,
                    'program_id' => $programId,
                    'permission_id' => $permissionId,
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
            'id' => 'required|exists:role_program_permission,id',
        ]);

        DB::table('role_program_permission')->where('id', $request->id)->delete();

        return redirect()->back()->with('success', 'Permission removed successfully!');
    }
    public function removeRole(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:role_program_permission,id',
        ]);

        DB::table('roles')->where('id', $request->id)->delete();

        return redirect()->back()->with('success', 'Permission removed successfully!');
    }
}
