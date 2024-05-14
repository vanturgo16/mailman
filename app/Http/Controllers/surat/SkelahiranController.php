<?php

namespace App\Http\Controllers\surat;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sk_kelahiran;
use App\Models\jeniskelamin;
use App\Models\sambutan;
use App\Models\agama;
use PDF;

class SkelahiranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 

    public function index()
    {
        $kelahiran= Sk_kelahiran::where('status',0)->get();
        $kelahiran_ok= Sk_kelahiran::where('status',1)->get();
        $kelahiran_trash =Sk_kelahiran::onlyTrashed()->get();
        return view('admin.sk.kelahiran.index',compact('kelahiran','kelahiran_ok','kelahiran_trash'));

    }

    public function show($id)
    {
        $sambutan=sambutan::first();
        $kelahiran=Sk_kelahiran::where('id', $id)->first();
        return view('admin.sk.kelahiran.show',compact('kelahiran','sambutan')); 
    }
    public function edit($id)
    {
        $ag=agama::get();
        $jk=jeniskelamin::get();
        $kelahiran=Sk_kelahiran::where('id', $id)->first();
        return view('admin.sk.kelahiran.edit',compact('kelahiran','ag','jk'));
    }

    public function update(Request $request, Sk_kelahiran $kelahiran)
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

        $kelahiran = Sk_kelahiran::findOrFail($kelahiran->id);
        $kelahiran->update([

            'nama'                 => $request->input('nama'),
            'tempat'               => $request->input('tempat'),
            'tgl'                  => $request->input('tgl'),
            'jk'                   => $request->input('jk'),
            'pekerjaan'            => $request->input('pekerjaan'),
            'alamat'               => $request->input('alamat'),
            'nama_ibu'             => $request->input('nama_ibu'),
            'nama_ayah'            => $request->input('nama_ayah'),
            'anak_ke'              => $request->input('anak_ke'),
            'status'               => 1,
            'operator'             => $request->input('operator')
            
            
        ]);

        if($kelahiran){
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
        $domisili= Sk_kelahiran::findOrFail($id);
        $domisili->delete();
      
        $domisili->update([
            'operator'         => Auth::user()->name
        ]);
        return back();
      
    }
    public function trash()
    {
        $kelahiran = Sk_kelahiran::onlyTrashed()->paginate(10);
        return view('admin.sk.kelahiran.index',compact('kelahiran'));
    }

    public function restore($id)
    {
        $kelahiran = Sk_kelahiran::withTrashed()->findOrFail($id);
        if($kelahiran->trashed()){
            
            $kelahiran->restore();
            Alert::info('InfoAlert','Data Berhasil Di Kembalikan');
            return back();
        
        } else {
        
            Alert::error('ErrorAlert','Gagal Di Kembalikan');
            return back();
        }
       
    }

    public function deletePermanent($id)
    {
        $kelahiran = Sk_kelahiran::withTrashed()->findOrFail($id);
        if(!$kelahiran->trashed())
        {
            return back();

        } else {
            $kelahiran->forceDelete();
            return back();
        }
    }   

}
