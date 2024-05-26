<?php

namespace App\Http\Controllers;

use App\Models\Sator;
use App\Models\WorkUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sators = Sator::orderBy('sator_name','asc')->get();
        $datas = WorkUnit::orderBy('work_code','asc')->orderBy('work_name','asc')->get();
        return view('parameter.unitkerja.index',compact('datas','sators'));
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
            "kode_unit" => "required",
            "nama_unit" => "required",
            "nama_kepala_unit" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = WorkUnit::create([
                'work_code' => $request->kode_unit,
                'work_name' => $request->nama_unit,
                'work_head_name' => $request->nama_kepala_unit,
                'work_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Unit Kerja']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Unit Kerja!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkUnit  $workUnit
     * @return \Illuminate\Http\Response
     */
    public function show(WorkUnit $workUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkUnit  $workUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkUnit $workUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkUnit  $workUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($id);
        $request->validate([
            "kode_unit" => "required",
            "nama_unit" => "required",
            "nama_kepala_unit" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = WorkUnit::where('id',$id)
            ->update([
                'work_code' => $request->kode_unit,
                'work_name' => $request->nama_unit,
                'work_head_name' => $request->nama_kepala_unit,
                'work_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Unit Kerja']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Unit Kerja!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkUnit  $workUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = WorkUnit::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Unit Kerja']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Unit Kerja!']);
        }
    }

    public function aktif($id){
        //dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = WorkUnit::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Unit Kerja']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Unit Kerja!']);
        }
    }
}
