<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;
    protected $table = 'master_letter';
    protected $fillable = [
        'let_code',
        'let_name',
        'let_desc',
        'created_by'
    ];
}
