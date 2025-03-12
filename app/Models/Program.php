<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'Permission_programs';
    protected $fillable = ['name'];
    protected $guarded = ['id'];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'Permission_role_program_permission');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'Permission_role_program_permission');
    }
    
}
