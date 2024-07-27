<?php

namespace App\Http\Controllers;

use App\Models\Sator;
use App\Models\SubSator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubSatorController extends Controller
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
        $sators = Sator::orderBy('sator_name','asc')->get();
        $datas = SubSator::select(
                'master_sub_sator.*',
                'master_sator.id as id_sator',
                'master_sator.sator_name',
            )
            ->leftJoin('master_sator','master_sub_sator.id_sator','master_sator.id')
            ->orderBy('sub_sator_name','asc')
            ->get();
        return view('parameter.subsator.index',compact('datas','sators'));
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
            "nama_sator" => "required",
            "nama_sub_sator" => "required",
        ]);
        
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = SubSator::create([
                'id_sator' => $request->nama_sator,
                'sub_sator_name' => $request->nama_sub_sator,
                'sub_sator_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Sub Satuan Organisasi']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Sub Satuan Organisasi!']);
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
        //dd($id);
        $request->validate([
            "nama_sator" => "required",
            "nama_sub_sator" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = SubSator::where('id',$id)
            ->update([
                'id_sator' => $request->nama_sator,
                'sub_sator_name' => $request->nama_sub_sator,
                'sub_sator_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Sub Satuan Organisasi']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Sub Satuan Organisasi!']);
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
            $store = SubSator::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Sub Satuan Organisasi']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Sub Satuan Organisasi!']);
        }
    }

    public function aktif($id){
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = SubSator::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Sub Satuan Organisasi']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Sub Satuan Organisasi!']);
        }
    }
}
