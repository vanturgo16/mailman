<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarGedung extends Model
{
    use HasFactory;
    protected $table = 'daftar_gedung';
    protected $fillable = [
        'kode_gedung',
        'nama_gedung',
        'kapasitas_gedung',
        'keterangan_gedung',
        'created_by',
    ];
}
