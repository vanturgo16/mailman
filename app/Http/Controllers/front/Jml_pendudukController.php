<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jml_penduduk;

class Jml_pendudukController extends Controller
{
    public function index()
    {
        $jml=Jml_penduduk::get();
        return view('frontand.jml_penduduk',compact('jml'));
    }
}
