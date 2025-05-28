<?php

namespace App\Http\Controllers;
use App\Models\IncommingMail;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
{
    public function index()
    {
        //dd ('hai');
        $datas = IncommingMail::get();
        return view('parameter.expedisi.index',compact('datas'));
    }
}
