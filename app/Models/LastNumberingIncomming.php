<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastNumberingIncomming extends Model
{
    use HasFactory;
    protected $table = 'last_numbering_incomming';
    protected $guarded=[
        'id'
    ];
}
