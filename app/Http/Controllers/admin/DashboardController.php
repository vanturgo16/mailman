<?php

namespace App\Http\Controllers\admin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profildesa;
use App\Models\Sk_domisili;
use App\Models\PesanWarga;
use App\Models\AgendaPejabat;
use App\Models\Pejabat_daerah;
use App\Models\Jabat;
use App\Models\opd;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 
    public function index()
    {
        // belum
        $ag   = AgendaPejabat::where('sk',0)->count();
        $ap   = AgendaPejabat::where('sk','<>',0)->count();

        $profil_desa=Profildesa::first();
        $pesan=PesanWarga::limit(20)->get();

        return view('admin.dashboard',compact('pesan','profil_desa','ag','ap'));
    }

    public function index_pesan()
    {
        $warga=PesanWarga::get();
        return view('admin.pesanwarga.index',compact('warga'));
    }

    public function index_trash()
    {
        $pesan_trash =PesanWarga::onlyTrashed()->get();
        return view('admin.pesanwarga.trash',compact('pesan_trash'));
    }

    public function show_pesan($id)
    {
        $profil_desa=Profildesa::first();
        $warga=PesanWarga::where('id', $id)->first();
        return view('admin.pesanwarga.show',compact('warga','profil_desa')); 
    }

    public function pesan_destroy($id)
    {
        $warga= PesanWarga::findOrFail($id);
        $warga->delete();
        
        return back();
      
    }

    public function pesan_restore($id)
    {
        $warga = PesanWarga::withTrashed()->findOrFail($id);
        if($warga->trashed()){
            
            $warga->restore();
            Alert::info('InfoAlert','Data Berhasil Di Kembalikan');
            return back();
        
        } else {
        
            Alert::error('ErrorAlert','Gagal Di Kembalikan');
            return back();
        }
       
    }

    public function deletePermanent($id)
    {
        $warga = PesanWarga::withTrashed()->findOrFail($id);
        if(!$warga->trashed())
        {
            return back();

        } else {
            $warga->forceDelete();
            return back();
        }
    }   
  
}
