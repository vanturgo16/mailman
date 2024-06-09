<?php

namespace App\Http\Controllers;

use App\Models\DaftarBaris;
use App\Models\DaftarGedung;
use App\Models\DaftarLantai;
use App\Models\DaftarRak;
use App\Models\DaftarRuang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarBarisController extends Controller
{
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

        $datas = DaftarBaris::select(
            'daftar_baris.*',
            'daftar_gedung.nama_gedung',
            'daftar_lantai.nama_lantai',
            'daftar_ruang.nama_ruang',
            'daftar_rak.nama_rak',
            'daftar_gedung.id as id_gedung',
            'daftar_lantai.id as id_lantai',
            'daftar_ruang.id as id_ruang',
            'daftar_rak.id as id_rak',
        )
        ->leftJoin('daftar_rak','daftar_baris.id_rak','daftar_rak.id')
        ->leftJoin('daftar_ruang','daftar_rak.id_ruang','daftar_ruang.id')
        ->leftJoin('daftar_lantai','daftar_ruang.id_lantai','daftar_lantai.id')
        ->leftJoin('daftar_gedung','daftar_lantai.id_gedung','daftar_gedung.id')
        ->orderBy('nama_ruang','asc')->get();

        // dd($datas);
    
        return view('baris.index',compact('datas','ruangs','lantais','gedungs','raks'));
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
            "nama_rak" => "required",
            "kode_baris" => "required",
            "nama_baris" => "required",
            "kapasitas" => "required"
        ]);

        //dd('hai');
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarBaris::create([
                'id_rak' => $request->nama_rak,
                'kode_baris' => $request->kode_baris,
                'nama_baris' => $request->nama_baris,
                'kapasitas_baris' => $request->kapasitas,
                'keterangan_baris' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Baris']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Baris!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarBaris  $daftarBaris
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarBaris $daftarBaris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarBaris  $daftarBaris
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarBaris $daftarBaris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarBaris  $daftarBaris
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            "nama_rak" => "required",
            "kode_baris" => "required",
            "nama_baris" => "required",
            "kapasitas" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarBaris::where('id',$id)
            ->update([
                'id_rak' => $request->nama_rak,
                'kode_baris' => $request->kode_baris,
                'nama_baris' => $request->nama_baris,
                'kapasitas_baris' => $request->kapasitas,
                'keterangan_baris' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Baris']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Baris!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarBaris  $daftarBaris
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarBaris::where('id',$id)
            ->update([
                'is_active' => 0,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Hapus Data Baris']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Hapus Data Baris!']);
        }
    }

    public function aktif($id){
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarBaris::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Aktifkan Data Baris']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Aktifkan Data Baris!']);
        }
    }
}
