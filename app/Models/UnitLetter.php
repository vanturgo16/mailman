<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitLetter extends Model
{
    use HasFactory;
    protected $table = 'master_unit_letter';
    protected $fillable = [
        'unit_name',
        'unit_desc',
        'category',
        'created_by'
    ];
}
