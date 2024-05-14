<?php

namespace App\Http\Controllers\front;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\jeniskelamin;
use App\Models\Sk_kelahiran;
use App\Models\Sk_domisili;
use App\Models\sk_kematian;
use App\Models\Pendidikan;
use App\Models\Sk_usaha;
use App\Models\Sk_sktm;
use App\Models\Skck;
use App\Models\agama;
use App\Models\Sk_menikah;
use App\Models\Sk_pindah;

class SuratonlineController extends Controller
{
   
    public function create_domisili()
    {
        
        $agama=agama::orderBy('id', 'DESC')->get();
        $jenis=jeniskelamin::orderBy('id', 'DESC')->get();
        return view('sk_online.domisili.create',compact('agama','jenis'));
    }
    
    public function cari_domisili(Request $request)
    {
        $this->validate($request,[
            'cari'         => 'required|min:3'
            
        ]);

        $domisili = Sk_domisili::when(request()->cari, function ($domisili) {
            $domisili = $domisili->where('nama', 'like', '%' . request()->cari . '%');
        })->paginate(150);
       
        return view('sk_online.domisili.cari',compact('domisili'));
    }

    public function store_domisili(Request $request)
    {

        $this->validate($request,[
            'nama'         => 'required',
            'jk'           => 'required',
            'tempat'       => 'required',
            'tgl'          => 'required',
            'negara'       => 'required',
            'agama'        => 'required',
            'pekerjaan'    => 'required',
            'alamat'       => 'required',
            'g-recaptcha-response' => 'required|recaptchav3:contact-us,0.5'
            
        ]);

        $domisili =Sk_domisili::create([
            'nama'       => $request->input('nama'),
            'jk'         => $request->input('jk'),
            'tempat'     => $request->input('tempat'),
            'tgl'        => $request->input('tgl'),
            'negara'     => $request->input('negara'), 
            'agama'      => $request->input('agama'), 
            'pekerjaan'  => $request->input('pekerjaan'), 
            'alamat'     => $request->input('alamat'), 
            'status'     =>0, 
            'operator'   =>0, 
            

        ]);

        if($domisili){
            //redirect dengan pesan sukses
            Alert::success('success','Data Anda Berhasil Di Kirim, Segera Lakukan Pengambilan Ke Kantor Desa');
            return redirect('/surat-online');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Data Anda Gagal Di Kirim');
            return redirect('/surat-online');
        }

    }

    public function create_kelahiran()
    {        
        $agama=agama::orderBy('id', 'DESC')->get();
        $jenis=jeniskelamin::orderBy('id', 'DESC')->get();
        return view('sk_online.kelahiran.create',compact('agama','jenis'));
    }
    public function cari_kelahiran(Request $request)
    {
        $this->validate($request,[
            'cari'         => 'required|min:3'
            
        ]);
        $kelahiran = Sk_kelahiran::when(request()->cari, function ($kelahiran) {
            $kelahiran = $kelahiran->where('nama', 'like', '%' . request()->cari . '%');
        })->paginate(150);
       
        return view('sk_online.kelahiran.cari',compact('kelahiran'));
    }

    public function store_kelahiran(Request $request)
    {
        
        $this->validate($request,[
            'nama'         => 'required',
            'tempat'       => 'required',
            'tgl'          => 'required',
            'jk'           => 'required',
            'pekerjaan'    => 'required',
            'alamat'       => 'required',
            'nama_ayah'    => 'required',
            'nama_ibu'     => 'required',
            'anak_ke'      => 'required',
        ]);

        $domisili =Sk_kelahiran::create([
            'nama'       => $request->input('nama'),
            'tempat'     => $request->input('tempat'),
            'tgl'        => $request->input('tgl'),
            'jk'         => $request->input('jk'),
            'pekerjaan'  => $request->input('pekerjaan'), 
            'alamat'     => $request->input('alamat'), 
            'nama_ayah'  => $request->input('nama_ayah'), 
            'nama_ibu'   => $request->input('nama_ibu'), 
            'anak_ke'    => $request->input('anak_ke'), 
            'status'     =>0, 
            'operator'   =>0, 

        ]);

        if($domisili){
            //redirect dengan pesan sukses
            Alert::success('success','Data Anda Berhasil Di Kirim, Segera Lakukan Pengambilan Ke Kantor Desa');
            return redirect('/surat-online');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Data Anda Gagal Di Kirim');
            return redirect('/surat-online');
        }

    }

    public function create_kematian()
    {        
        $agama=agama::orderBy('id', 'asc')->get();
        $jenis=jeniskelamin::orderBy('id', 'asc')->get();
        return view('sk_online.kematian.create',compact('agama','jenis'));
    }

    public function cari_kematian(Request $request)
    {
        $this->validate($request,[
            'cari'         => 'required|min:3'
            
        ]);
        $kematian = Sk_kematian::when(request()->cari, function ($kematian) {
            $kematian = $kematian->where('nama', 'like', '%' . request()->cari . '%');
        })->paginate(150);
        return view('sk_online.kematian.cari',compact('kematian'));
    }

    public function store_kematian(Request $request)
    {
        
        $this->validate($request,[
            'nama'         => 'required',
            'tempat'       => 'required',
            'tgl'          => 'required',
            'jk'           => 'required',
            'agama'        => 'required',
            'alamat'       => 'required',
            'waktu'        => 'required',
            'kronologi'    => 'required',
        ]);

        $kematian =sk_kematian::create([
            'nama'       => $request->input('nama'),
            'tempat'     => $request->input('tempat'),
            'tgl'        => $request->input('tgl'),
            'jk'         => $request->input('jk'),
            'agama'      => $request->input('agama'), 
            'alamat'     => $request->input('alamat'), 
            'waktu'      => $request->input('waktu'), 
            'kronologi'  => $request->input('kronologi'), 
            'status'     =>0, 
            'operator'   =>0, 

        ]);

        if($kematian){
            //redirect dengan pesan sukses
            Alert::success('success','Data Anda Berhasil Di Kirim, Segera Lakukan Pengambilan Ke Kantor Desa');
            return redirect('/surat-online');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Data Anda Gagal Di Kirim');
            return redirect('/surat-online');
        }

    }

    public function create_sktm()
    {        
        $agama=agama::orderBy('id', 'asc')->get();
        $jenis=jeniskelamin::orderBy('id', 'asc')->get();

        // dd($jenis);
        return view('sk_online.sktm.create',compact('agama','jenis'));
    }

    public function cari_sktm(Request $request)
    {
        $this->validate($request,[
            'cari'         => 'required|min:3'
            
        ]);
        $sktm = Sk_sktm::when(request()->cari, function ($sktm) {
            $sktm = $sktm->where('nama', 'like', '%' . request()->cari . '%');
        })->paginate(150);
   
        return view('sk_online.sktm.cari',compact('sktm'));
    }

    public function store_sktm(Request $request)
    {       
        $this->validate($request,[
            'nama'                  => 'required',
            'nik'                   => 'required',
            'jk'                    => 'required',
            'tempat'                => 'required',
            'tgl'                   => 'required',
            'agama'                 => 'required',
            'pekerjaan'             => 'required',
            'status'                => 'required',
            'alamat'                => 'required',

            'nama_ibu'              =>'required',
            'tgl_ibu'               =>'required',
            'agama_ibu'             =>'required',
            'pekerjaan_ibu'         =>'required',
            'status_ibu'            =>'required',
            'alamat_ibu'            =>'required',

            'nama_ayah'             =>'required',
            'tgl_ayah'              =>'required',
            'agama_ayah'            =>'required',
            'pekerjaan_ayah'        =>'required',
            'status_ayah'           =>'required',
            'alamat_ayah'           =>'required',
            
        ]);

        $sktm =Sk_sktm::create([
        
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
            'jk_ibu'               => 'P',
            'tgl_ibu'              => $request->input('tgl_ibu'),
            'agama_ibu'            => $request->input('agama_ibu'),
            'pekerjaan_ibu'        => $request->input('pekerjaan_ibu'),
            'status_ibu'           => $request->input('status_ibu'),
            'alamat_ibu'           => $request->input('alamat_ibu'),

            'nama_ayah'             => $request->input('nama_ayah'),
            'jk_ayah'               => 'L',
            'tgl_ayah'              => $request->input('tgl_ayah'),
            'agama_ayah'            => $request->input('agama_ayah'),
            'pekerjaan_ayah'        => $request->input('pekerjaan_ayah'),
            'status_ayah'           => $request->input('status_ayah'),
            'alamat_ayah'           => $request->input('alamat_ayah'),

            'status_proses'         => 0,
            'operator'              => 0,
        ]);

        if($sktm){
            //redirect dengan pesan sukses
            Alert::success('success','Data Anda Berhasil Di Kirim, Segera Lakukan Pengambilan Ke Kantor Desa');
            return redirect('/surat-online');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Data Anda Gagal Di Kirim');
            return redirect('/surat-online');
        }

    }

    public function create_usaha()
    {        
        $agama=agama::orderBy('id', 'asc')->get();
        $pen=Pendidikan::orderBy('id', 'asc')->get();
        $jenis=jeniskelamin::orderBy('id', 'asc')->get();
        return view('sk_online.usaha.create',compact('agama','jenis','pen'));
    }

    public function cari_usaha(Request $request)
    {
        $this->validate($request,[
            'cari'         => 'required|min:3'
            
        ]);
        $usaha = Sk_usaha::when(request()->cari, function ($usaha) {
            $usaha = $usaha->where('nama', 'like', '%' . request()->cari . '%');
        })->paginate(150);
      
        return view('sk_online.usaha.cari',compact('usaha'));
    }

    public function store_usaha(Request $request)
    {       
        $this->validate($request,[
            'nama'             => 'required',
            'nik'              => 'required',
            'jk'               => 'required',
            'tempat'           => 'required',
            'tgl'              => 'required',
            'pekerjaan'        => 'required',
            'alamat'           => 'required',

            'jns_usaha'        => 'required',
            'merek_usaha'      => 'required',
            'kry'              => 'required',
            'modal'            => 'required',
            'luas_bangunan'    => 'required',
            'bangunan_toko'    => 'required',
            'no_hp'            => 'required',
            'pendidikan'       => 'required',
            'alamat_usaha'     => 'required',
            
        ]);

        $usaha =Sk_usaha::create([
        
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
           
            'status'           => 0,
            'operator'         => 0,
        ]);

        if($usaha){
            //redirect dengan pesan sukses
            Alert::success('success','Data Anda Berhasil Di Kirim, Segera Lakukan Pengambilan Ke Kantor Desa');
            return redirect('/surat-online');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Data Anda Gagal Di Kirim');
            return redirect('/surat-online');
        }

    }

    public function create_skck()
    {        
        $agama=agama::orderBy('id', 'asc')->get();
        $jenis=jeniskelamin::orderBy('id', 'asc')->get();
        return view('sk_online.skck.create',compact('agama','jenis'));
    }

    public function cari_skck(Request $request)
    {
        $this->validate($request,[
            'cari'         => 'required|min:3'
            
        ]);
        $skck = skck::when(request()->cari, function ($skck) {
            $skck = $skck->where('nama', 'like', '%' . request()->cari . '%');
        })->paginate(150);
      
        return view('sk_online.skck.cari',compact('skck'));
    }
    public function store_skck(Request $request)
    {       
        $this->validate($request,[
            'nama'             => 'required',
            'jk'               => 'required',
            'tempat'           => 'required',
            'tgl'              => 'required',
            'negara'           => 'required',
            'agama'            => 'required',
            'nik'              => 'required',
            'pekerjaan'        => 'required',
            'status_kawin'     => 'required',
            'alamat'           => 'required',
            
        ]);

        $skck =Skck::create([
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
            'status'           => 0,
            'operator'         => 0,
        ]);

        if($skck){
            //redirect dengan pesan sukses
            Alert::success('success','Data Anda Berhasil Di Kirim, Segera Lakukan Pengambilan Ke Kantor Desa');
            return redirect('/surat-online');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Data Anda Gagal Di Kirim');
            return redirect('/surat-online');
        }

    }

    public function create_menikah()
    {        
        $agama=agama::orderBy('id', 'asc')->get();
        $jenis=jeniskelamin::orderBy('id', 'asc')->get();
        return view('sk_online.menikah.create',compact('agama','jenis'));
    }

    public function cari_menikah(Request $request)
    {
        $this->validate($request,[
            'cari'         => 'required|min:3'
            
        ]);
        $menikah = Sk_menikah::when(request()->cari, function ($menikah) {
            $menikah = $menikah->where('nama_ayah', 'like', '%' . request()->cari . '%');
        })->paginate(150);
      
        return view('sk_online.menikah.cari',compact('menikah'));
    }

    public function store_menikah(Request $request)
    {
        $this->validate($request,[
            'nama_ayah'         => 'required',
            'bin_ayah'          => 'required',
            'nik_ayah'          => 'required|min:16|max:16',
            'tempat_ayah'       => 'required',
            'tgl_ayah'          => 'required',
            'negara_ayah'       => 'required',
            'agama_ayah'        => 'required',
            'alamat_ayah'       => 'required',

            'nama_ibu'          => 'required',
            'bin_ibu'           => 'required',
            'nik_ibu'           => 'required|min:16|max:16',
            'tempat_ibu'        => 'required',
            'tgl_ibu'           => 'required',
            'negara_ibu'        => 'required',
            'agama_ibu'         => 'required',
            'alamat_ibu'        => 'required',

            'nama_anak'         => 'required',
            'nik_anak'          => 'required|min:16|max:16',
            'tempat_anak'       => 'required',
            'tgl_anak'          => 'required',
            'negara_anak'       => 'required',
            'agama_anak'        => 'required',
            'pekerjaan_anak'    => 'required',
            'alamat_anak'       => 'required',

            'nama_dgn'          => 'required',
            'bin_dgn'           => 'required',
            'nik_dgn'           => 'required|min:16|max:16',
            'tempat_dgn'        => 'required',
            'tgl_dgn'           => 'required',
            'negara_dgn'        => 'required',
            'agama_dgn'         => 'required',
            'pekerjaan_dgn'     => 'required',
            'alamat_dgn'        => 'required',
            'jk_anak'           => 'required',
        ]);

       
        $menikah =Sk_menikah::create([

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

           
            'status_kawin_l'    => $request->input('status_kawin_p'),
            'status_kawin_p'    => $request->input('status_kawin_p'),
            'istri_ke'          => $request->input('istri_ke'),

            'status'                => 0,
            'operator'              => 0,
            'nm_suami_atau_istri'   => $request->input('nm_suami_atau_istri'),
            'jk_anak'               => $request->input('jk_anak'),
                        
        ]);
        if($menikah){
            //redirect dengan pesan sukses
            Alert::success('success','Data Anda Berhasil Di Kirim, Segera Lakukan Pengambilan Ke Kantor Desa');
            return redirect('/surat-online');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Data Anda Gagal Di Kirim');
            return redirect('/surat-online');
        }
    }

    public function create_pindah()
    {        
        return view('sk_online.pindah.create');
    }

    public function cari_pindah(Request $request)
    {
        $this->validate($request,[
            'cari'         => 'required|min:16'
            
        ]);
        $pindah = Sk_pindah::when(request()->cari, function ($pindah) {
            $pindah = $pindah->where('kk', 'like', '%' . request()->cari . '%');
        })->paginate(150);
      
        return view('sk_online.pindah.cari',compact('pindah'));
    }

    public function store_pindah(Request $request)
    {
        $this->validate($request,[
            'kk'                    => 'required|min:16|max:20',
            'nm_kk'                 => 'required|min:3|max:50',
            'rt_asal'               => 'required',
            'rw_asal'               => 'required',
            'rw_asal'               => 'required',
            'provinsi_asal'         => 'required|min:5|max:50',
            'kab_kota_asal'         => 'required|min:5|max:50',
            'kec_asal'              => 'required|min:5|max:50',
            'desa_asal'             => 'required|min:5|max:50',
            'alasan_pindaj'         =>'required',

            'rt_tujuan'             => 'required',
            'rw_tujuan'             => 'required',
            'provinsi_tujuan'       => 'required|min:5|max:50',
            'kab_kota_tujuan'       => 'required|min:5|max:50',
            'kec_tujuan'            => 'required|min:5|max:50',
            'desa_tujuan'           => 'required|min:5|max:50',
            'kls_pindah'            => 'required|min:5|max:50',
            'jns_pindah'            => 'required',
            'sts_kk_tdk_pindah'     => 'required',
            'sts_kk_yg_pindah'      => 'required',
            'jml'                   => 'required',
        ]);

       
        $pindah =Sk_pindah::create([

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
            'status'                => 0,
            'operator'              => 0,
                        
        ]);
        if($pindah){
            //redirect dengan pesan sukses
            Alert::success('success','Data Anda Berhasil Di Kirim, Segera Lakukan Pengambilan Ke Kantor Desa');
            return redirect('/surat-online');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Data Anda Gagal Di Kirim');
            return redirect('/surat-online');
        }
    }

}
