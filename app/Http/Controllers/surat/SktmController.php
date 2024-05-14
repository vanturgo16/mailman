<?php

namespace App\Http\Controllers\surat;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\jeniskelamin;
use App\Models\Sk_sktm;
use App\Models\sambutan;
use App\Models\agama;
use PDF;

class SktmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 

    public function index()
    {
        $sktm= Sk_sktm::where('status_proses',0)->get();
        $sktm_ok= Sk_sktm::where('status_proses',1)->get();
        $sktm_trash =Sk_sktm::onlyTrashed()->get();

        return view('admin.sk.sktm.index',compact('sktm','sktm_ok','sktm_trash'));

    }

    public function show($id)
    {
        $sambutan=sambutan::first();
        $sktm=Sk_sktm::where('id', $id)->first();
        return view('admin.sk.sktm.show',compact('sktm','sambutan')); 
    }

    public function edit($id)
    {
        $ag=agama::get();
        $jk=jeniskelamin::get();
        $sktm=Sk_sktm::where('id', $id)->first();
        return view('admin.sk.sktm.edit',compact('sktm','ag','jk'));
    }

    public function update(Request $request, Sk_sktm $sktm)
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

        $sktm = sk_sktm::findOrFail($sktm->id);
        $sktm->update([

            'nama'                 => $request->input('nama'),
            'nik'                  => $request->input('nik'),
            'jk'                   => $request->input('jk'),
            'tempat'               => $request->input('tempat'),
            'tgl'                  => $request->input('tgl'),
            'agama'                => $request->input('agama'),
            'pekerjaan'            => $request->input('pekerjaan'),
            'status'               => $request->input('status'),
            'alamat'               => $request->input('alamat'),

            'nama_ibu'             => $request->input('nama_ibu'),
            'jk_ibu'               => $request->input('jk_ibu'),
            'tgl_ibu'              => $request->input('tgl_ibu'),
            'agama_ibu'            => $request->input('agama_ibu'),
            'pekerjaan_ibu'        => $request->input('pekerjaan_ibu'),
            'status_ibu'           => $request->input('status_ibu'),
            'alamat_ibu'           => $request->input('alamat_ibu'),

            'nama_ayah'             => $request->input('nama_ayah'),
            'jk_ayah'               => $request->input('jk_ayah'),
            'tgl_ayah'              => $request->input('tgl_ayah'),
            'agama_ayah'            => $request->input('agama_ayah'),
            'pekerjaan_ayah'        => $request->input('pekerjaan_ayah'),
            'status_ayah'           => $request->input('status_ayah'),
            'alamat_ayah'           => $request->input('alamat_ayah'),

            'status_proses'         => 1,
            'operator'              => $request->input('operator')
            
            
        ]);

        if($sktm){
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
        $domisili= Sk_sktm::findOrFail($id);
        $domisili->delete();
        $domisili->update([
            'operator'         => Auth::user()->name
        ]);
        return back();
      
    }
    public function trash()
    {
        $sktm = Sk_sktm::onlyTrashed()->paginate(10);
        return view('admin.sk.sktm.index',compact('sktm'));
    }

    public function restore($id)
    {
        $sktm = Sk_sktm::withTrashed()->findOrFail($id);
        if($sktm->trashed()){
            
            $sktm->restore();
            Alert::info('InfoAlert','Data Berhasil Di Kembalikan');
            return back();
        
        } else {
        
            Alert::error('ErrorAlert','Gagal Di Kembalikan');
            return back();
        }
       
    }

    public function deletePermanent($id)
    {
        $sktm = Sk_sktm::withTrashed()->findOrFail($id);
        if(!$sktm->trashed())
        {
            return back();

        } else {
            $sktm->forceDelete();
            return back();
        }
    }   
}
