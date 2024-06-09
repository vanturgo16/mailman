<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastNumbering extends Model
{
    use HasFactory;
    protected $table = 'last_numbering';
    protected $guarded=[
        'id'
    ];
}
