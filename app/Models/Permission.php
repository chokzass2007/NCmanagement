<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'Permission_permissions'; // ชื่อตารางที่ถูกต้อง
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'Permission_role_program_permission');
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'Permission_role_program_permission');
    }
}
