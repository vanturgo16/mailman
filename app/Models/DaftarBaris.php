<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarBaris extends Model
{
    use HasFactory;
    protected $table = 'daftar_baris';
    protected $fillable = [
        'id_rak',
        'kode_baris',
        'nama_baris',
        'kapasitas_baris',
        'keterangan_baris',
        'is_active',
        'created_by',
    ];
}
