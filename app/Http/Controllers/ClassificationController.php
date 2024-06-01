<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\ClassIsFinalException;

class ClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Classification::orderBy('classification_name','asc')->get();
        return view('parameter.klasifikasi.index',compact('datas'));
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
            "nama_klasifikasi" => "required",
            "tahun_retensi" => "required",
            "bulan_retensi" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Classification::create([
                'classification_name' => $request->nama_klasifikasi,
                'retention_year' => $request->tahun_retensi,
                'retention_month' => $request->bulan_retensi,
                'classification_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data klasifikasi Arsip']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data klasifikasi Arsip!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function show(Classification $classification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function edit(Classification $classification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $request->validate([
            "nama_klasifikasi" => "required",
            "tahun_retensi" => "required",
            "bulan_retensi" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Classification::where('id',$id)
            ->update([
                'classification_name' => $request->nama_klasifikasi,
                'retention_year' => $request->tahun_retensi,
                'retention_month' => $request->bulan_retensi,
                'classification_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Klasifikasi Arsip']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Klasifikasi Arsip!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classification  $classification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Classification::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Klasifikasi Arsip']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Klasifikasi Arsip!']);
        }
    }

    public function aktif($id){
        //dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Classification::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Klasifikasi Arsip']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Klasifikasi Arsip!']);
        }
    }
}
