<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueNumbOutMail extends Model
{
    use HasFactory;
    protected $table = 'que_numb_outgoing_mail';
    protected $guarded=[
        'id'
    ];
}
