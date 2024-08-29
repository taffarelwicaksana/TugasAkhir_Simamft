<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $fillable = ['nim_nip', 'password', 'role_id', 'nama'];

    // User belongs to a Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Conditional relationships based on role
    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }
}
