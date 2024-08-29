<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nama_role'];

    // Role has many Users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
