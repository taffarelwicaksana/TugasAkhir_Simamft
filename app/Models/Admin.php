<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $fillable = ['id_user', 'nama_admin', 'email_sso'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
