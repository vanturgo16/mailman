<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sk_kelahiran extends Model
{
    // use HasFactory;
    protected $guarded=[];
    use SoftDeletes;

}
