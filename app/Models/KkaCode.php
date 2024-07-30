<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KkaCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kka_type',
        'kka_code',
        'kka_desc',
        'created_by'
    ];
}
