<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodis';
    protected $fillable = ['nama_prodi', 'id_fakultas'];  // Tambahkan 'id_fakultas' ke dalam $fillable

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'prodi_id');
    }

    public function dosbings()
    {
        return $this->hasMany(Dosbing::class, 'id_prodi');  // Menambahkan relasi hasMany ke Dosbing
    }
    // Fungsi untuk menghitung rata-rata IPK di program studi
    
}
