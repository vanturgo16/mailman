<?php

namespace App\Http\Controllers;

use App\Models\DaftarGedung;
use App\Models\DaftarLantai;
use App\Models\DaftarRuang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarRuangController extends Controller
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
        $lantais = DaftarLantai::get();

        $gedungs = DaftarGedung::get();

        $datas = DaftarRuang::select(
            'daftar_ruang.*',
            'daftar_lantai.nama_lantai',
            'daftar_gedung.nama_gedung',
            'daftar_lantai.id as id_lantai',
            'daftar_gedung.id as id_gedung',
        )
        ->leftJoin('daftar_lantai','daftar_ruang.id_lantai','daftar_lantai.id')
        ->leftJoin('daftar_gedung','daftar_lantai.id_gedung','daftar_gedung.id')
        ->orderBy('nama_ruang','asc')->get();

        // dd($datas);
    
        return view('ruang.index',compact('datas','lantais','gedungs'));
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
            "nama_lantai" => "required",
            "kode_ruang" => "required",
            "nama_ruang" => "required",
            "kapasitas" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarRuang::create([
                'id_lantai' => $request->nama_lantai,
                'kode_ruang' => $request->kode_ruang,
                'nama_ruang' => $request->nama_ruang,
                'kapasitas_ruang' => $request->kapasitas,
                'keterangan_ruang' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Ruang']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Ruang!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarRuang  $daftarRuang
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarRuang $daftarRuang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarRuang  $daftarRuang
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarRuang $daftarRuang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarRuang  $daftarRuang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            "nama_gedung" => "required",
            "nama_lantai" => "required",
            "kode_ruang" => "required",
            "nama_ruang" => "required",
            "kapasitas" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarRuang::where('id',$id)
            ->update([
                'id_lantai' => $request->nama_lantai,
                'kode_ruang' => $request->kode_ruang,
                'nama_ruang' => $request->nama_ruang,
                'kapasitas_ruang' => $request->kapasitas,
                'keterangan_ruang' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Ruang']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Ruang!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarRuang  $daftarRuang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarRuang::where('id',$id)
            ->update([
                'is_active' => 0,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Hapus Data Ruang']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Hapus Data Ruang!']);
        }
    }

    public function aktif($id){
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = DaftarRuang::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Aktifkan Data Ruang']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Aktifkan Data Ruang!']);
        }
    }
}
