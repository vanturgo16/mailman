<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncommingMail extends Model
{
    use HasFactory;
    protected $table = 'incomming_mails';
    protected $guarded=[
        'id'
    ];
}
