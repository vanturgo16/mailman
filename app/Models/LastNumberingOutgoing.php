<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastNumberingOutgoing extends Model
{
    use HasFactory;
    protected $table = 'last_numbering_outgoing';
    protected $guarded=[
        'id'
    ];
}
