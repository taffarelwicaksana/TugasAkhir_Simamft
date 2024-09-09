<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpkRecord extends Model
{
    use HasFactory;
    protected $table = 'ipk_records';
    protected $fillable = ['siswa_id', 'ipk', 'total_sks'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
