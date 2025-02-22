<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }


    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_program_permission')->withPivot('program_id');
    }


    public function programs()
    {
        return $this->belongsToMany(Program::class, 'role_program_permission');
    }
}
