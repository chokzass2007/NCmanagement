<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name','email','password',];
    protected $guarded = ['id'];
    
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'Permission_user_roles');
    }

    public function hasPermission($permission, $program)
    {
        // ตรวจสอบว่าผู้ใช้มีบทบาทที่เกี่ยวข้องกับโปรแกรมและสิทธิ์หรือไม่
        foreach ($this->roles as $role) { 
            if ($role->permissions()->where('name', $permission)->where('program_id', $program->id)->exists()) {
                return true;
            }
        }
        return false;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
