<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarKolom extends Model
{
    use HasFactory;
    protected $table = 'daftar_kolom';
    protected $fillable = [
        'id_baris',
        'kode_kolom',
        'nama_kolom',
        'kapasitas_kolom',
        'keterangan_kolom',
        'is_active',
        'created_by',
    ];
}
