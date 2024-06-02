<?php

namespace App\Http\Controllers;

use App\Models\DaftarGedung;
use App\Models\DaftarLantai;
use App\Models\DaftarRak;
use App\Models\DaftarRuang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarRakController extends Controller
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

        $datas = DaftarRak::select(
            'daftar_rak.*',
            'daftar_gedung.nama_gedung',
            'daftar_lantai.nama_lantai',
            'daftar_ruang.nama_ruang',
            'daftar_gedung.id as id_gedung',
            'daftar_lantai.id as id_lantai',
            'daftar_ruang.id as id_ruang',
        )
        ->leftJoin('daftar_ruang','daftar_rak.id_ruang','daftar_rak.id')
        ->leftJoin('daftar_lantai','daftar_ruang.id_lantai','daftar_lantai.id')
        ->leftJoin('daftar_gedung','daftar_lantai.id_gedung','daftar_gedung.id')
        ->orderBy('nama_ruang','asc')->get();

        // dd($datas);
    
        return view('rak.index',compact('datas','ruangs','lantais','gedungs'));
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
            "nama_ruang" => "required",
            "kode_rak" => "required",
            "nama_rak" => "required",
            "kapasitas" => "required"
        ]);

        //dd('hai');
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarRak::create([
                'id_ruang' => $request->nama_lantai,
                'kode_rak' => $request->kode_rak,
                'nama_rak' => $request->nama_rak,
                'kapasitas_rak' => $request->kapasitas,
                'keterangan_rak' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Rak']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Rak!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarRak  $daftarRak
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarRak $daftarRak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarRak  $daftarRak
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarRak $daftarRak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarRak  $daftarRak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            "nama_ruang" => "required",
            "kode_rak" => "required",
            "nama_rak" => "required",
            "kapasitas" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarRak::where('id',$id)
            ->update([
                'id_ruang' => $request->nama_lantai,
                'kode_rak' => $request->kode_rak,
                'nama_rak' => $request->nama_rak,
                'kapasitas_rak' => $request->kapasitas,
                'keterangan_rak' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Rak']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Rak!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarRak  $daftarRak
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarRak::where('id',$id)
            ->update([
                'is_active' => 0,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Hapus Data Rak']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Hapus Data Rak!']);
        }
    }

    public function aktif($id){
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarRak::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Aktifkan Data Rak']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Aktifkan Data Rak!']);
        }
    }
}
