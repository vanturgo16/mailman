<?php

namespace App\Http\Controllers;

use App\Models\Sator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Sator::orderBy('sator_name','asc')->get();
        return view('parameter.sator.index',compact('datas'));
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
            "nama_satuan" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Sator::create([
                'sator_name' => $request->nama_satuan,
                'sator_desc' => $request->keterangan,
                'sator_address' => $request->alamat,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Satuan Organisasi']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Satuan Organisasi!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sator  $sator
     * @return \Illuminate\Http\Response
     */
    public function show(Sator $sator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sator  $sator
     * @return \Illuminate\Http\Response
     */
    public function edit(Sator $sator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sator  $sator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $request->validate([
            "nama_satuan" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Sator::where('id',$id)
            ->update([
                'sator_name' => $request->nama_satuan,
                'sator_desc' => $request->keterangan,
                'sator_address' => $request->alamat,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Satuan Organisasi']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Satuan Organisasi!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sator  $sator
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Sator::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Satuan Organisasi']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Satuan Organisasi!']);
        }
    }

    public function aktif($id){
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Sator::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Satuan Organisasi']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Satuan Organisasi!']);
        }
    }
}
