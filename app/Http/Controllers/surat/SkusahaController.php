<?php

namespace App\Http\Controllers\surat;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\jeniskelamin;
use App\Models\Pendidikan;
use App\Models\sambutan;
use App\Models\Sk_usaha;

class SkusahaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 

    public function index()
    {
        $usaha= Sk_usaha::where('status',0)->get();
        $usaha_ok= Sk_usaha::where('status',1)->get();
        $usaha_trash =Sk_usaha::onlyTrashed()->get();

        return view('admin.sk.usaha.index',compact('usaha','usaha_ok','usaha_trash'));

    }
    public function show($id)
    {
        $sambutan=sambutan::first();
        $usaha=Sk_usaha::where('id', $id)->first();
        return view('admin.sk.usaha.show',compact('usaha','sambutan')); 
    }
    public function edit($id)
    {
        $jk=jeniskelamin::get();
        $pen=Pendidikan::get();
        $usaha=Sk_usaha::where('id', $id)->first();
        return view('admin.sk.usaha.edit',compact('usaha','pen','jk'));
    }

    public function update(Request $request, Sk_usaha $usaha)
    {

        $usaha = Sk_usaha::findOrFail($usaha->id);
        $usaha->update([

            'nama'             => $request->input('nama'),
            'nik'              => $request->input('nik'),
            'jk'               => $request->input('jk'),
            'tempat'           => $request->input('tempat'),
            'tgl'              => $request->input('tgl'),
            'pekerjaan'        => $request->input('pekerjaan'),
            'alamat'           => $request->input('alamat'),

            'jns_usaha'        => $request->input('jns_usaha'),
            'merek_usaha'      => $request->input('merek_usaha'),
            'kry'              => $request->input('kry'),
            'modal'            => $request->input('modal'),
            'luas_bangunan'    => $request->input('luas_bangunan'),
            'bangunan_toko'    => $request->input('bangunan_toko'),
            'no_hp'            => $request->input('no_hp'),
            'pendidikan'       => $request->input('pendidikan'),
            'alamat_usaha'     => $request->input('alamat_usaha'),
           
            'status'           => 1,
            'operator'         => $request->input('operator')

        ]);

        if($usaha){
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
        $domisili= Sk_usaha::findOrFail($id);
        $domisili->delete();
        $domisili->update([
            'operator'         => Auth::user()->name
        ]);
        return back();
      
    }
    public function trash()
    {
        $usaha = Sk_usaha::onlyTrashed()->paginate(10);
        return view('admin.sk.usaha.index',compact('usaha'));
    }

    public function restore($id)
    {
        $usaha = Sk_usaha::withTrashed()->findOrFail($id);
        if($usaha->trashed()){
            
            $usaha->restore();
            Alert::info('InfoAlert','Data Berhasil Di Kembalikan');
            return back();
        
        } else {
        
            Alert::error('ErrorAlert','Gagal Di Kembalikan');
            return back();
        }
       
    }

    public function deletePermanent($id)
    {
        $usaha = Sk_usaha::withTrashed()->findOrFail($id);
        if(!$usaha->trashed())
        {
            return back();

        } else {
            $usaha->forceDelete();
            return back();
        }
    }   
}
