<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleProgramPermission extends Model
{
    use HasFactory;

    protected $table = 'Permission_role_program_permission'; // ชื่อตารางที่ถูกต้อง
    protected $fillable = ['user_id','role_id', 'program_id', 'Permission_id'];
    protected $guarded = ['id'];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
