<?php

namespace App\Http\Controllers\surat;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sk_domisili;
use App\Models\jeniskelamin;
use App\Models\sambutan;
use App\Models\agama;
use PDF;

class SkdomisiliController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
        if (session('success')) {
            Alert::success(session('success'));
        }

        if (session('error')) {
            Alert::error(session('error'));
        }
    } 

    public function index()
    {
        $domisili= Sk_domisili::where('status',0)->get();
        $domisili_ok= Sk_domisili::where('status',1)->get();
        $domisili_trash = Sk_domisili::onlyTrashed()->get();

        return view('admin.sk.domisili.index',compact('domisili','domisili_ok','domisili_trash'));

    }

    public function show($id)
    {
        $sambutan=sambutan::first();
        $domisili=Sk_domisili::where('id', $id)->first();
        return view('admin.sk.domisili.show',compact('domisili','sambutan')); 
    }

    // public function cetak($id)
    // {
    //     $domisili=Sk_domisili::where('id',1)->first();
        
    //     $dom =[
    //         'nama'=>$domisili->nama,
    //         'jk'=>$domisili->jk,
    //         'tgl'=>$domisili->tgl
    //     ];

    //     // dd($dom);
    //     $data = [
    //         'title' => 'SURAT KETERANGAN BERDOMISILI',
    //         'date' => date('m/d/Y')
    //     ];
    //     $pdf = PDF::loadView('admin.sk.domisili.cetak', $data,$dom);
    
    //     return $pdf->download('domisili.pdf');
    // }

    public function edit($id)
    {
        $ag=agama::get();
        $jk=jeniskelamin::get();
        $domisili=Sk_domisili::where('id', $id)->first();
        return view('admin.sk.domisili.edit',compact('domisili','ag','jk'));
    }

    public function update(Request $request, Sk_domisili $domisili)
    {
        $this->validate($request,[
            // 'nama'           => 'required',
            // 'jk'             => 'required',
            // 'tempat'         => 'required',
            // 'tgl'            => 'required',
            // 'negara'         => 'required',
            // 'agama'          => 'required',
            // 'pekerjaan'      => 'required',
            // 'alamat'         => 'required'
          
        ]);

        $sk_domisili = Sk_domisili::findOrFail($domisili->id);
        $sk_domisili->update([

            'nama'             => $request->input('nama'),
            'jk'               => $request->input('jk'),
            'tempat'           => $request->input('tempat'),
            'tgl'              => $request->input('tgl'),
            'negara'           => $request->input('negara'),
            'agama'            => $request->input('agama'),
            'pekerjaan'        => $request->input('pekerjaan'),
            'alamat'           => $request->input('alamat'),
            'status'           => 1,
            'operator'         => $request->input('operator')
            
            
        ]);

        if($sk_domisili){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Update Dan Di Proses');
            return back();

        }else{
            //redirect dengan pesan error
            Alert::error('error','Gagal Di Update');
            return back();

        }
    }

    public function destroy($id)
    {
        $domisili= Sk_domisili::findOrFail($id);
        $domisili->delete();
        $domisili->update([
            'operator'         => Auth::user()->name
        ]);
        
        return back();
      
    }
    public function trash()
    {
        $domisili = Sk_domisili::onlyTrashed()->paginate(10);
        return view('admin.sk.domisili.index',compact('domisili'));
    }

    public function restore($id)
    {
        $domisili = Sk_domisili::withTrashed()->findOrFail($id);
        if($domisili->trashed()){
            
            $domisili->restore();
            Alert::info('InfoAlert','Data Berhasil Di Kembalikan');
            return back();
        
        } else {
        
            Alert::error('ErrorAlert','Gagal Di Kembalikan');
            return back();
        }
       
    }

    public function deletePermanent($id)
    {
        $domisili = Sk_domisili::withTrashed()->findOrFail($id);
        if(!$domisili->trashed())
        {
            return back();

        } else {
            $domisili->forceDelete();
            return back();
        }
    }   
}
