<?php

namespace App\Http\Controllers;

use App\Models\DaftarBaris;
use App\Models\DaftarGedung;
use App\Models\DaftarKolom;
use App\Models\DaftarLantai;
use App\Models\DaftarRak;
use App\Models\DaftarRuang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarKolomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(['permission:lokasi simpan']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gedungs = DaftarGedung::get();
        $lantais = DaftarLantai::get();
        $ruangs = DaftarRuang::get();
        $raks = DaftarRak::get();
        $rows = DaftarBaris::get();

        $datas = DaftarKolom::select(
            'daftar_kolom.*',
            'daftar_gedung.nama_gedung',
            'daftar_lantai.nama_lantai',
            'daftar_ruang.nama_ruang',
            'daftar_rak.nama_rak',
            'daftar_baris.nama_baris',
            'daftar_gedung.id as id_gedung',
            'daftar_lantai.id as id_lantai',
            'daftar_ruang.id as id_ruang',
            'daftar_rak.id as id_rak',
            'daftar_baris.id as id_baris',
        )
        ->leftJoin('daftar_baris','daftar_kolom.id_baris','daftar_baris.id')
        ->leftJoin('daftar_rak','daftar_baris.id_rak','daftar_rak.id')
        ->leftJoin('daftar_ruang','daftar_rak.id_ruang','daftar_ruang.id')
        ->leftJoin('daftar_lantai','daftar_ruang.id_lantai','daftar_lantai.id')
        ->leftJoin('daftar_gedung','daftar_lantai.id_gedung','daftar_gedung.id')
        ->orderBy('nama_kolom','asc')->get();

        // dd($datas);
    
        return view('kolom.index',compact('datas','ruangs','lantais','gedungs','raks','rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            "nama_baris" => "required",
            "kode_kolom" => "required",
            "nama_kolom" => "required",
            "kapasitas" => "required"
        ]);

        //dd('hai');
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarKolom::create([
                'id_baris' => $request->nama_baris,
                'kode_kolom' => $request->kode_kolom,
                'nama_kolom' => $request->nama_kolom,
                'kapasitas_kolom' => $request->kapasitas,
                'keterangan_kolom' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Kolom']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Kolom!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarKolom  $daftarKolom
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarKolom $daftarKolom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarKolom  $daftarKolom
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarKolom $daftarKolom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarKolom  $daftarKolom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            "nama_baris" => "required",
            "kode_kolom" => "required",
            "nama_kolom" => "required",
            "kapasitas" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarKolom::where('id',$id)
            ->update([
                'id_baris' => $request->nama_baris,
                'kode_kolom' => $request->kode_kolom,
                'nama_kolom' => $request->nama_kolom,
                'kapasitas_kolom' => $request->kapasitas,
                'keterangan_kolom' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Kolom']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Kolom!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarKolom  $daftarKolom
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarKolom::where('id',$id)
            ->update([
                'is_active' => 0,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Hapus Data Kolom']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Hapus Data Kolom!']);
        }
    }

    public function aktif($id){
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarKolom::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Aktifkan Data Kolom']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Aktifkan Data Kolom!']);
        }
    }
}
