<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_program_permission');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_program_permission');
    }
    
}
