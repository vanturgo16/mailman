<?php

namespace App\Http\Controllers;

use App\Models\KkaCode;
use App\Models\KkaType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KkaTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('hai');
        $datas = KkaType::orderBy('kka_type','asc')->get();
        return view('parameter.kkatype.index',compact('datas'));
    }

    public function listKKA($id){
        $id = decrypt($id);
        $dataType = KkaType::where('id',$id)->first();
        $datas = KkaCode::where('id_kka_type',$id)->orderBy('kka_code','asc')->get();
        return view('parameter.kkacode.index',compact('datas','dataType'));
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
        //dd('hai');
        $request->validate([
            "kka_type" => "required|unique:kka_types,kka_type",
            "kka_primary_code" => "required|unique:kka_types,kka_primary_code",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = KkaType::create([
                'kka_type' => strtoupper($request->kka_type),
                'kka_primary_code' => strtoupper($request->kka_primary_code),
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Tipe Kode Klasifikasi Arsip']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Tipe Kode Klasifikasi Arsip!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd('hai');
        $request->validate([
            "kka_type" => "required",
            "kka_primary_code" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = KkaType::where('id',$id)
            ->update([
                'kka_type' => strtoupper($request->kka_type),
                'kka_primary_code' => strtoupper($request->kka_primary_code),
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Tipe Kode Klasifikasi Arsip']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Tipe Kode Klasifikasi Arsip!']);
        }
    }

    public function storeKKA(Request $request, $id)
    {
        $request->validate([
            "kka_code" => "required|unique:kka_codes,kka_code",
            "keterangan" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = KkaCode::create(
            [
                'id_kka_type' => $id,
                'kka_code' => strtoupper($request->kka_code),
                'kka_desc' => strtoupper($request->keterangan),
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Kode Klasifikasi Arsip']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Kode Klasifikasi Arsip!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = KkaType::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Tipe KKA']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Tipe KKA!']);
        }
    }

    public function aktif($id){
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = KkaType::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Tipe KKA']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Tipe KKA!']);
        }
    }
}
