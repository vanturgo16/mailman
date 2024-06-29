<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    protected $table = 'master_complain';
    protected $fillable = [
        'com_code',
        'com_name',
        'com_desc',
        'created_by'
    ];
}
