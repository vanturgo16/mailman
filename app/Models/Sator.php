<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sator extends Model
{
    use HasFactory;
    protected $table = 'master_sator';
    protected $fillable = [
        'sator_name',
        'sator_desc',
        'sator_address',
        'created_by'
    ];
}
