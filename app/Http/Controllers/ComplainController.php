<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Complain::orderBy('com_code','asc')->orderBy('com_name','asc')->get();
        return view('parameter.pengaduan.index',compact('datas'));
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
            "kode_pengaduan" => "required",
            "nama_pengaduan" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Complain::create([
                'com_code' => $request->kode_pengaduan,
                'com_name' => $request->nama_pengaduan,
                'com_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Jenis Pengaduan']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Jenis Pengaduan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function show(Complain $complain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function edit(Complain $complain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $request->validate([
            "kode_pengaduan" => "required",
            "nama_pengaduan" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Complain::where('id',$id)
            ->update([
                'com_code' => $request->kode_pengaduan,
                'com_name' => $request->nama_pengaduan,
                'com_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Jenis Pengaduan']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Jenis Pengaduan!']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Complain::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Jenis Pengaduan']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Jenis Pengaduan!']);
        }
    }

    public function aktif($id){
        //dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Complain::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Jenis Pengaduan']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Jenis Pengaduan!']);
        }
    }
}
