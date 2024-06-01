<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;
    protected $table = 'master_classification';
    protected $fillable = [
        'classification_name',
        'retention_year',
        'retention_month',
        'classification_desc',
        'created_by'
    ];
}
