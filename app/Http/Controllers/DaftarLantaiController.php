<?php

namespace App\Http\Controllers;

use App\Models\DaftarGedung;
use App\Models\DaftarLantai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarLantaiController extends Controller
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
        $lantais = DaftarLantai::select(
            'daftar_lantai.*',
            'daftar_gedung.nama_gedung'
        )
        ->leftJoin('daftar_gedung','daftar_lantai.id_gedung','daftar_gedung.id')
        ->get();
        $gedungs = DaftarGedung::get();
    
        return view('lantai.index',compact('lantais','gedungs'));
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
            "nama_gedung" => "required",
            "kode_lantai" => "required",
            "nama_lantai" => "required",
            "kapasitas" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarLantai::create([
                'id_gedung' => $request->nama_gedung,
                'kode_lantai' => $request->kode_lantai,
                'nama_lantai' => $request->nama_lantai,
                'kapasitas_lantai' => $request->kapasitas,
                'keterangan_lantai' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Lantai']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Lantai!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarLantai  $daftarLantai
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarLantai $daftarLantai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarLantai  $daftarLantai
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarLantai $daftarLantai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarLantai  $daftarLantai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaftarLantai $daftarLantai, $id)
    {
        //dd($request->all());
        $request->validate([
            "nama_gedung" => "required",
            "kode_lantai" => "required",
            "nama_lantai" => "required",
            "kapasitas" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarLantai::where('id',$id)
            ->update([
                'id_gedung' => $request->nama_gedung,
                'kode_lantai' => $request->kode_lantai,
                'nama_lantai' => $request->nama_lantai,
                'kapasitas_lantai' => $request->kapasitas,
                'keterangan_lantai' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Lantai']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Lantai!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarLantai  $daftarLantai
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaftarLantai $daftarLantai, $id)
    {
        // dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarLantai::where('id',$id)
            ->update([
                'is_active' => 0,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Hapus Data Lantai']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Hapus Data Lantai!']);
        }
    }

    public function aktif(DaftarLantai $daftarLantai,$id){
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarLantai::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Aktif Data Lantai']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Aktif Data Lantai!']);
        }
    }
}
