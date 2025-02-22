<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_program_permission');
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'role_program_permission');
    }
}
