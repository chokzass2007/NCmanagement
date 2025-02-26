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
        $users = User::all();
        $roles = Role::all();
        $programs = Program::all();
        $permissions = Permission::all();

        return view('admin.ManageProgram', compact('roles', 'programs', 'permissions', 'users'));
    }
    public function program()
    {
        $programs = Program::all();
        return view('admin.Program', compact('programs'));
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

            if (!$exists) {
                RoleProgramPermission::create([
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
    public function removePermission(Request $request)
    {
        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'role_id'     => 'required|exists:roles,id',
            'program_id'  => 'required|exists:programs,id',
            'permissions' => 'required|array',
        ]);

        // ค้นหาผู้ใช้
        $user = User::find($request->user_id);

        // ค้นหา Role ของผู้ใช้
        $role = $user->roles()->where('roles.id', $request->role_id)->first();

        if ($role) {
            // ลบเฉพาะสิทธิ์ที่ถูกเลือกออกจาก Role นี้
            $role->permissions()->detach($request->permissions);
        }

        return redirect()->back()->with('success', 'Selected permissions removed successfully!');
    }
}
