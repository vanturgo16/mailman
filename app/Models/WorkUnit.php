<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkUnit extends Model
{
    use HasFactory;
    protected $table = 'master_workunit';
    protected $fillable = [
        'work_code',
        'work_name',
        'work_head_name',
        'work_desc',
        'created_by',
    ];
}
