<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastNumberingIncommingLitnadin extends Model
{
    use HasFactory;
    protected $table = 'last_numbering_incomming_litnadin';
    protected $guarded=[
        'id'
    ];
}
