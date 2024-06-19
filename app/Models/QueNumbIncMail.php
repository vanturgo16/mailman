<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueNumbIncMail extends Model
{
    use HasFactory;
    protected $table = 'que_numb_incomming_mail';
    protected $guarded=[
        'id'
    ];
}
