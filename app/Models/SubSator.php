<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSator extends Model
{
    use HasFactory;
    protected $table = 'master_sub_sator';
    protected $fillable = [
        'id_sator',
        'sub_sator_name',
        'sub_sator_desc',
        'created_by'
    ];
}
