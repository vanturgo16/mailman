<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingMail extends Model
{
    use HasFactory;
    protected $table = 'outgoing_mails';
    protected $guarded=[
        'id'
    ];
}
