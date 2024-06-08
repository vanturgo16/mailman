<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarRuang extends Model
{
    use HasFactory;
    protected $table = 'daftar_ruang';
    protected $fillable = [
        'id_lantai',
        'kode_ruang',
        'nama_ruang',
        'kapasitas_ruang',
        'keterangan_ruang',
        'is_active',
        'created_by',
    ];
}
