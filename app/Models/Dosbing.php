<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosbing extends Model
{
    protected $table = 'dosbings';
    protected $fillable = ['nama_dosbing', 'NIP', 'id_prodi'];  // Tambahkan 'id_prodi' ke dalam $fillable

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'dosbing_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');  // Menambahkan relasi belongsTo ke Prodi
    }
}
