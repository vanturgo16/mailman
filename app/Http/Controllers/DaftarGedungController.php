<?php

namespace App\Http\Controllers;

use App\Models\DaftarGedung;
use App\Models\DaftarLantai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarGedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gedungs = DaftarGedung::get();
    
        return view('gedung.index',compact('gedungs'));
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
            "kode_gedung" => "required",
            "nama_gedung" => "required",
            "kapasitas" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarGedung::create([
                'kode_gedung' => $request->kode_gedung,
                'nama_gedung' => $request->nama_gedung,
                'kapasitas_gedung' => $request->kapasitas,
                'keterangan_gedung' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Gedung']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Gedung!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarGedung  $daftarGedung
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarGedung $daftarGedung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarGedung  $daftarGedung
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarGedung $daftarGedung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarGedung  $daftarGedung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaftarGedung $daftarGedung, $id)
    {
        //dd($request->all());
        $request->validate([
            "kode_gedung" => "required",
            "nama_gedung" => "required",
            "kapasitas" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarGedung::where('id',$id)
            ->update([
                'kode_gedung' => $request->kode_gedung,
                'nama_gedung' => $request->nama_gedung,
                'kapasitas_gedung' => $request->kapasitas,
                'keterangan_gedung' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Gedung']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Gedung!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarGedung  $daftarGedung
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaftarGedung $daftarGedung, $id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarGedung::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Gedung']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Gedung!']);
        }
    }

    public function aktif(DaftarGedung $daftarGedung,$id){
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarGedung::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Gedung']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Gedung!']);
        }
    }
}
