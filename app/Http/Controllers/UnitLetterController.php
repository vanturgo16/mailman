<?php

namespace App\Http\Controllers;

use App\Models\UnitLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(['permission:master parameter']);
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = UnitLetter::orderBy('unit_name','asc')->get();
        return view('parameter.satnas.index',compact('datas'));
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
            "nama_satuan_naskah" => "required",
            "kategori" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = UnitLetter::create([
                'unit_name' => $request->nama_satuan_naskah,
                'unit_desc' => $request->keterangan,
                'category' => $request->kategori,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Satuan Naskah']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Satuan Naskah!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitLetter  $unitLetter
     * @return \Illuminate\Http\Response
     */
    public function show(UnitLetter $unitLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitLetter  $unitLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitLetter $unitLetter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnitLetter  $unitLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $request->validate([
            "nama_satuan_naskah" => "required",
            "kategori" => "required"
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = UnitLetter::where('id',$id)
            ->update([
                'unit_name' => $request->nama_satuan_naskah,
                'unit_desc' => $request->keterangan,
                'category' => $request->kategori,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Satuan Naskah']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Satuan Naskah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnitLetter  $unitLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = UnitLetter::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Satuan Naskah']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Satuan Naskah!']);
        }
    }

    public function aktif($id){
        //dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = UnitLetter::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Satuan Naskah']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Satuan Naskah!']);
        }
    }
}
