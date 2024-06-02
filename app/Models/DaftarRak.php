<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarRak extends Model
{
    use HasFactory;
    protected $table = 'daftar_rak';
    protected $fillable = [
        'id_ruang',
        'kode_rak',
        'nama_rak',
        'kapasitas_rak',
        'keterangan_rak',
        'is_active',
        'created_by',
    ];
}
