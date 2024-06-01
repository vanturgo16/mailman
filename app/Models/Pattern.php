<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;
    protected $table = 'master_pattern';
    protected $fillable = [
        'let_id',
        'pat_simple',
        'pat_mix',
        'pat_type',
        'created_by'
    ];
}
