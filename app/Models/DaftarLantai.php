<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarLantai extends Model
{
    use HasFactory;
    protected $table = 'daftar_lantai';
    protected $fillable = [
        'id_gedung',
        'kode_lantai',
        'nama_lantai',
        'kapasitas_lantai',
        'keterangan_lantai',
        'is_active',
        'created_by',
    ];
}
