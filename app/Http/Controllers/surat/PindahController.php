<?php

namespace App\Http\Controllers\surat;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sk_pindah;
use App\Models\Kk_pindah;
use App\Models\Profildesa;
use App\Models\jeniskelamin;
use App\Models\sambutan;

class PindahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 

    public function index()
    {
        $pindah= Sk_pindah::where('status',0)->get();
        $pindah_ok= Sk_pindah::where('status',1)->get();
        $pindah_trash =Sk_pindah::onlyTrashed()->get();

        return view('admin.sk.pindah.index',compact('pindah','pindah_ok','pindah_trash'));
    }

    public function store(Request $request)
    {
 
        $this->validate($request,[
            // 'id_pindah'    => 'required',
            // 'nama'         => 'required',
            // 'tempat'       => 'required',
            // 'tgl'          => 'required',
            // 'jk'           => 'required',
            // 'status_kawin' => 'required',
            // 'pekerjaan'    => 'required',
            
        ]);

        $kk_pindah =Kk_pindah::create([
            'id_pindah'        => $request->input('id_pindah'),
            'nama'             => $request->input('nama'),
            'tempat'           => $request->input('tempat'),
            'tgl'              => $request->input('tgl'),
            'jk'               => $request->input('jk'),
            'status_kawin'     => $request->input('status_kawin'),
            'pekerjaan'        => $request->input('pekerjaan'),
            'status'           => 1,
            'operator'         => Auth::user()->name,
        ]);

        if($kk_pindah){
            //redirect dengan pesan sukses
            Alert::success('success','Data Anda Berhasil Di Tambah');
             return back();
        }else{
            //redirect dengan pesan error
            Alert::error('error','Data Anda Gagal Di Kirim');
             return back();
        }

    }

    public function show($id)
    {
        $profil_desa=Profildesa::first();
        $sambutan=sambutan::first();

        $pindah = DB::table('sk_pindahs')
        ->join('kk_pindahs','sk_pindahs.id','=','kk_pindahs.id_pindah')
        ->select('sk_pindahs.*','kk_pindahs.*')
        ->where('sk_pindahs.id', $id)->first();

        $kk_pindah=Kk_pindah::where('id_pindah', $id)->get();

        $pemohon=Kk_pindah::where('id_pindah', $id)
        ->where('status','1')->first();

        return view('admin.sk.pindah.show',compact('pindah','kk_pindah',
        'profil_desa','sambutan','pemohon')); 
    }

    public function edit($id)
    {
        $jenis=jeniskelamin::orderBy('id', 'DESC')->get();
        $pindah=Sk_pindah::where('id', $id)->first();
        $kk_pindah=Kk_pindah::where('id_pindah', $id)->get();
        return view('admin.sk.pindah.edit',compact('pindah','kk_pindah','jenis'));
    }

    public function update(Request $request, Sk_pindah $pindah)
    {
        $this->validate($request,[
            'kk'                    => 'required|min:16|max:20',
            'nm_kk'                 => 'required',
            'rt_asal'               => 'required',
            'rw_asal'               => 'required',
            'rw_asal'               => 'required',
            'provinsi_asal'         => 'required|min:5|max:50',
            'kab_kota_asal'         => 'required',
            'kec_asal'              => 'required',
            'desa_asal'             => 'required',
            'alasan_pindaj'         =>'required',

            'rt_tujuan'             => 'required',
            'rw_tujuan'             => 'required',
            'provinsi_tujuan'       => 'required',
            'kab_kota_tujuan'       => 'required',
            'kec_tujuan'            => 'required',
            'desa_tujuan'           => 'required',
            'kls_pindah'            => 'required',
            'jns_pindah'            => 'required',
            'sts_kk_tdk_pindah'     => 'required',
            'sts_kk_yg_pindah'      => 'required',
            'jml'                   => 'required',
          
        ]);
       
        $pindah = Sk_pindah::findOrFail($pindah->id);
        $pindah->update([

            'kk'                    => $request->input('kk'),
            'nm_kk'                 => $request->input('nm_kk'),
            'rt_asal'               => $request->input('rt_asal'),
            'rw_asal'               => $request->input('rw_asal'),
            'provinsi_asal'         => $request->input('provinsi_asal'),
            'kab_kota_asal'         => $request->input('kab_kota_asal'),
            'kec_asal'              => $request->input('kec_asal'),
            'desa_asal'             => $request->input('desa_asal'),
            'alasan_pindaj'         => $request->input('alasan_pindaj'),

            'rt_tujuan'             => $request->input('rt_tujuan'),
            'rw_tujuan'             => $request->input('rw_tujuan'),
            'provinsi_tujuan'       => $request->input('provinsi_tujuan'),
            'kab_kota_tujuan'       => $request->input('kab_kota_tujuan'),
            'kec_tujuan'            => $request->input('kec_tujuan'),
            'desa_tujuan'           => $request->input('desa_tujuan'),
            'kls_pindah'            => $request->input('kls_pindah'),
            'jns_pindah'            => $request->input('jns_pindah'),
            'sts_kk_tdk_pindah'     => $request->input('sts_kk_tdk_pindah'),
            'sts_kk_yg_pindah'      => $request->input('sts_kk_yg_pindah'),
            'jml'                   => $request->input('jml'),
            'status'                => 1,
            'operator'              => Auth::user()->name,
            
            
        ]);

        if($pindah){
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
        $pindah= Sk_pindah::findOrFail($id);
        $pindah->delete();
        $pindah->update([
            'operator'         => Auth::user()->name
        ]);
        
        return back();
      
    }
    public function trash()
    {
        $pindah = Sk_pindah::onlyTrashed()->paginate(10);
        return view('admin.sk.pindah.index',compact('pindah'));
    }

    public function restore($id)
    {
        $pindah = Sk_pindah::withTrashed()->findOrFail($id);
        if($pindah->trashed()){
            
            $pindah->restore();
            Alert::info('InfoAlert','Data Berhasil Di Kembalikan');
            return back();
        
        } else {
        
            Alert::error('ErrorAlert','Gagal Di Kembalikan');
            return back();
        }
       
    }

    public function deletePermanent($id)
    {
        $pindah = Sk_pindah::withTrashed()->findOrFail($id);
        if(!$pindah->trashed())
        {
            return back();

        } else {
            $pindah->forceDelete();
            return back();
        }
    }
    
    
}
