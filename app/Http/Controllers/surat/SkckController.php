<?php

namespace App\Http\Controllers\surat;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jeniskelamin;
use App\Models\sambutan;
use App\Models\Skck;
use App\Models\agama;


class SkckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 

    public function index()
    {
        $skck= Skck::where('status',0)->get();
        $skck_ok= Skck::where('status',1)->get();
        $skck_trash =Skck::onlyTrashed()->get();

        return view('admin.sk.skck.index',compact('skck','skck_ok','skck_trash'));

    }

    public function show($id)
    {
        $sambutan=sambutan::first();
        $skck=Skck::where('id', $id)->first();
        return view('admin.sk.skck.show',compact('skck','sambutan')); 
    }

    public function edit($id)
    {
        $ag=agama::get();
        $jk=jeniskelamin::get();
        $skck=Skck::where('id', $id)->first();
        return view('admin.sk.skck.edit',compact('skck','ag','jk'));
    }

    public function update(Request $request, Skck $skck)
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
      
        $skck = Skck::findOrFail($skck->id);
        $skck->update([

            'nama'             => $request->input('nama'),
            'jk'               => $request->input('jk'),
            'tempat'           => $request->input('tempat'),
            'tgl'              => $request->input('tgl'),
            'negara'           => $request->input('negara'),
            'agama'            => $request->input('agama'),
            'nik'              => $request->input('nik'),
            'pekerjaan'        => $request->input('pekerjaan'),
            'status_kawin'     => $request->input('status_kawin'),
            'alamat'           => $request->input('alamat'),
            'status'           => 1,
            'operator'         => $request->input('operator')
            
            
        ]);

        if($skck){
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
        $skck= Skck::findOrFail($id);
        $skck->delete();
        $skck->update([
            'operator'         => Auth::user()->name
        ]);
        
        return back();
      
    }
    public function trash()
    {
        $skck = Skck::onlyTrashed()->paginate(10);
        return view('admin.sk.skck.index',compact('skck'));
    }

    public function restore($id)
    {
        $skck = Skck::withTrashed()->findOrFail($id);
        if($skck->trashed()){
            
            $skck->restore();
            Alert::info('InfoAlert','Data Berhasil Di Kembalikan');
            return back();
        
        } else {
        
            Alert::error('ErrorAlert','Gagal Di Kembalikan');
            return back();
        }
       
    }

    public function deletePermanent($id)
    {
        $skck = Skck::withTrashed()->findOrFail($id);
        if(!$skck->trashed())
        {
            return back();

        } else {
            $skck->forceDelete();
            return back();
        }
    }   

}
