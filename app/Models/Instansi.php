<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $table = 'master_instansi';
    protected $fillable = [
        'name_ins',
        'address_ins',
        'zipcode_ins',
        'phone_ins',
        'fax_ins',
        'is_active',
        'created_by'
    ];
}
