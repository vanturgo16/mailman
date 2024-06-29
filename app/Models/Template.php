<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $table = 'master_template';
    protected $fillable = [
        'template_name',
        'template_version',
        'template_b_date',
        'template_e_date',
        'classification_id',
        'template_desc',
        'template_path',
        'template_filename',
        'template_filetype',
        'created_by'
    ];
}
