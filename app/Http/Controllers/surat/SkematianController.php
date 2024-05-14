<?php

namespace App\Http\Controllers\surat;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\sk_kematian;
use App\Models\jeniskelamin;
use App\Models\sambutan;
use App\Models\agama;
use PDF;

class SkematianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 

    public function index()
    {
        $skmatian= sk_kematian::where('status',0)->get();
        $skmatian_ok= sk_kematian::where('status',1)->get();
        $skmatian_trash =sk_kematian::onlyTrashed()->get();

        return view('admin.sk.kematian.index',compact('skmatian','skmatian_ok','skmatian_trash'));

    }

    public function show($id)
    {
        $sambutan=sambutan::first();
        $skmatian=sk_kematian::where('id', $id)->first();
        return view('admin.sk.kematian.show',compact('skmatian','sambutan')); 
    }

    public function edit($id)
    {
        $ag=agama::get();
        $jk=jeniskelamin::get();
        $skmatian=sk_kematian::where('id', $id)->first();
        return view('admin.sk.kematian.edit',compact('skmatian','ag','jk'));
    }

    public function update(Request $request, sk_kematian $kematian)
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

        $kematian = sk_kematian::findOrFail($kematian->id);
        $kematian->update([

            'nama'             => $request->input('nama'),
            'tempat'           => $request->input('tempat'),
            'tgl'              => $request->input('tgl'),
            'jk'               => $request->input('jk'),
            'agama'            => $request->input('agama'),
            'alamat'           => $request->input('alamat'),
            'waktu'            => $request->input('waktu'),
            'kronologi'        => $request->input('kronologi'),
            'status'           => 1,
            'operator'         => $request->input('operator')
            
            
        ]);

        if($kematian){
         //redirect dengan pesan sukses
         Alert::success('success','Berhasil Di Update');
         return back();

     }else{
         //redirect dengan pesan error
         Alert::error('error','Gagal Di Update');
         return back();

        }

        
    }

    public function destroy($id)
    {
        $skem= sk_kematian::findOrFail($id);
        $skem->delete();
        $skem->update([
            'operator'         => Auth::user()->name
        ]);
        return back();
      
    }
    public function trash()
    {
        $kematian = sk_kematian::onlyTrashed()->paginate(10);
        return view('admin.sk.kematian.index',compact('kematian'));
    }

    public function restore($id)
    {
        $kematian = sk_kematian::withTrashed()->findOrFail($id);
        if($kematian->trashed()){
            
            $kematian->restore();
            Alert::info('InfoAlert','Data Berhasil Di Kembalikan');
            return back();
        
        } else {
        
            Alert::error('ErrorAlert','Gagal Di Kembalikan');
            return back();
        }
       
    }

    public function deletePermanent($id)
    {
        $kematian = sk_kematian::withTrashed()->findOrFail($id);
        if(!$kematian->trashed())
        {
            return back();

        } else {
            $kematian->forceDelete();
            return back();
        }
    }   
}

