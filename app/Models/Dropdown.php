<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dropdown extends Model
{
    use HasFactory;
    protected $table = 'master_dropdown';
    protected $guarded=[
        'id'
    ];
}
