<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressIncommingMail extends Model
{
    use HasFactory;
    protected $table = 'progress_incomming_mails';
    protected $guarded=[
        'id'
    ];
}
