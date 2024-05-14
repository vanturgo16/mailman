<?php

namespace App\Http\Controllers\sk;

use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sk_domisili;

class DomisiliController extends Controller
{
   
public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    }

public function index()
    {
        $domisili= Sk_domisili::where('status',0)->get();
        $domisili_ok= Sk_domisili::where('status',1)->get();

        return view('sk.index',compact('domisili','domisili_ok'));

    }
public function show()
    {
        $domisili=Sk_domisili::where('id',1)->first();
        
        $dom =[
            'nama'=>$domisili->nama,
            'jk'=>$domisili->jk,
            'tgl'=>$domisili->tgl
        ];

        // dd($dom);
        $data = [
            'title' => 'SURAT KETERANGAN BERDOMISILI',
            'date' => date('m/d/Y')
        ];
        $pdf = PDF::loadView('sk.show', $data,$dom);
    
        return $pdf->download('domisili.pdf');
    }
}
