<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa'; 

    protected $fillable = [
        'nama',
        'NIM',
        'no_hp',
        'nama_orangtua',
        'prodi_id',
        'fakultas_id',
        'dosbing_id',
        'user_id',
        'semester_berjalan',
        'angkatan',
        'email_sso',
        'nilai_s1',
        'sks_s1',
        'nilai_s2',
        'sks_s2',
        'nilai_s3',
        'sks_s3',
        'nilai_s4',
        'sks_s4',
        'nilai_s5',
        'sks_s5',
        'nilai_s6',
        'sks_s6',
        'nilai_s7',
        'sks_s7',
        'nilai_s8',
        'sks_s8'
    ];

    // Definisikan relasi jika ada
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }

    public function dosbing()
    {
        return $this->belongsTo(Dosbing::class, 'dosbing_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ipk()
    {
        return $this->hasOne(IpkRecord::class, 'siswa_id');
    }
    
}
