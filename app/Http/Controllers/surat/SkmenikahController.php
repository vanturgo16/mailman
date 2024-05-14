<?php

namespace App\Http\Controllers\surat;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jeniskelamin;
use App\Models\Sk_menikah;
use App\Models\agama;
use App\Models\sambutan;


class SkmenikahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 

    public function index()
    {
        $menikah= Sk_menikah::where('status',0)->get();
        $menikah_ok= Sk_menikah::where('status',1)->get();
        $menikah_trash =Sk_menikah::onlyTrashed()->get();

        return view('admin.sk.menikah.index',compact('menikah','menikah_ok','menikah_trash'));

    }

    public function show($id)
    {
        $menikah=Sk_menikah::where('id', $id)->first();
        return view('admin.sk.menikah.show',compact('menikah')); 
    }
    public function show_sk($id)
    {
        $sambutan=sambutan::first();
        $menikah=Sk_menikah::where('id', $id)->first();
        return view('admin.sk.menikah.sk_pengantar',compact('menikah','sambutan')); 
    }

    public function edit($id)
    {
        $ag=agama::get();
        $jk=jeniskelamin::get();
        $menikah=Sk_menikah::where('id', $id)->first();
        return view('admin.sk.menikah.edit',compact('menikah','ag','jk'));
    }

    public function update(Request $request, Sk_menikah $menikah)
    {
        $this->validate($request,[

          
        ]);
      
        $menikah = Sk_menikah::findOrFail($menikah->id);
        $menikah->update([

            'nama_ayah'         => $request->input('nama_ayah'),
            'bin_ayah'          => $request->input('bin_ayah'),
            'nik_ayah'          => $request->input('nik_ayah'),
            'tempat_ayah'       => $request->input('tempat_ayah'),
            'tgl_ayah'          => $request->input('tgl_ayah'),
            'negara_ayah'       => $request->input('negara_ayah'),
            'agama_ayah'        => $request->input('agama_ayah'),
            'alamat_ayah'       => $request->input('alamat_ayah'),

            'nama_ibu'          => $request->input('nama_ibu'),
            'bin_ibu'           => $request->input('bin_ibu'),
            'nik_ibu'           => $request->input('nik_ibu'),
            'tempat_ibu'        => $request->input('tempat_ibu'),
            'tgl_ibu'           => $request->input('tgl_ibu'),
            'negara_ibu'        => $request->input('negara_ibu'),
            'agama_ibu'         => $request->input('agama_ibu'),
            'alamat_ibu'        => $request->input('alamat_ibu'),

            'nama_anak'         => $request->input('nama_anak'),
            'bin_anak'          => $request->input('nama_ayah'),
            'nik_anak'          => $request->input('nik_anak'),
            'tempat_anak'       => $request->input('tempat_anak'),
            'tgl_anak'          => $request->input('tgl_anak'),
            'negara_anak'       => $request->input('negara_anak'),
            'agama_anak'        => $request->input('agama_anak'),
            'pekerjaan_anak'    => $request->input('pekerjaan_anak'),
            'alamat_anak'       => $request->input('alamat_anak'),

            'nama_dgn'          => $request->input('nama_dgn'),
            'bin_dgn'           => $request->input('bin_dgn'),
            'nik_dgn'           => $request->input('nik_dgn'),
            'tempat_dgn'        => $request->input('tempat_dgn'),
            'tgl_dgn'           => $request->input('tgl_dgn'),
            'negara_dgn'        => $request->input('negara_dgn'),
            'agama_dgn'         => $request->input('agama_dgn'),
            'pekerjaan_dgn'     => $request->input('pekerjaan_dgn'),
            'alamat_dgn'        => $request->input('alamat_dgn'),

           
            'status_kawin_p'    => $request->input('status_kawin_p'),
            'istri_ke'          => $request->input('istri_ke'),

            'status'                => 1,
            'operator'              => $request->input('operator'),
            'nm_suami_atau_istri'   => $request->input('nm_suami_atau_istri'),
            'jk_anak'               => $request->input('jk_anak'),
                        
        ]);

        if($menikah){
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
        $menikah= Sk_menikah::findOrFail($id);
        $menikah->delete();
        $menikah->update([
            'operator'         => Auth::user()->name
        ]);
      
        return back();
      
    }
    public function trash()
    {
        $menikah = Sk_menikah::onlyTrashed()->paginate(10);
        return view('admin.sk.menikah.index',compact('menikah'));
    }

    public function restore($id)
    {
        $menikah = Sk_menikah::withTrashed()->findOrFail($id);
        if($menikah->trashed()){
            
            $menikah->restore();
            Alert::info('InfoAlert','Data Berhasil Di Kembalikan');
            return back();
        
        } else {
        
            Alert::error('ErrorAlert','Gagal Di Kembalikan');
            return back();
        }
       
    }

    public function deletePermanent($id)
    {
        $menikah = Sk_menikah::withTrashed()->findOrFail($id);
        if(!$menikah->trashed())
        {
            return back();

        } else {
            $menikah->forceDelete();
            return back();
        }
    }   
}
