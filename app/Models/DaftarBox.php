<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarBox extends Model
{
    use HasFactory;
    protected $table = 'daftar_box';
    protected $fillable = [
        'id_kolom',
        'kode_box',
        'nama_box',
        'keterangan_box',
        'is_active',
        'created_by',
    ];
}
