<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'Permission_roles';
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'Permission_user_roles');
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'Permission_role_program_permission')->withPivot('program_id');
    }


    public function programs()
    {
        return $this->belongsToMany(Program::class, 'Permission_role_program_permission');
    }
}
