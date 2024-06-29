<?php

namespace App\Http\Controllers;

use App\Models\Dropdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DropdownController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(['permission:master dropdown']);
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('hai');
        $category = Dropdown::select('category')->get();
        $category = $category->unique('category');

        $datas = Dropdown::orderBy('category','asc')->get();

        return view('dropdown.index',compact('datas','category'));
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
            "category" => "required",
            "name_value" => "required",
            "code_format" => "required",
        ]);

        DB::beginTransaction();
        try {
            $store = Dropdown::create([
                'category' => $request->category,
                'name_value' => $request->name_value,
                'code_format' => $request->code_format,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Dropdown']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Dropdown!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dropdown  $dropdown
     * @return \Illuminate\Http\Response
     */
    public function show(Dropdown $dropdown)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dropdown  $dropdown
     * @return \Illuminate\Http\Response
     */
    public function edit(Dropdown $dropdown)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dropdown  $dropdown
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd('hai');
        $request->validate([
            "category" => "required",
            "name_value" => "required",
            "code_format" => "required",
        ]);

        DB::beginTransaction();
        try {
            $store = Dropdown::where('id',$id)
            ->update([
                'category' => $request->category,
                'name_value' => $request->name_value,
                'code_format' => $request->code_format,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Dropdown']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Dropdown!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dropdown  $dropdown
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id);
        DB::beginTransaction();
        try {
            $delete = Dropdown::where('id',$id)
            ->delete();

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Hapus Data Dropdown']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Hapus Data Dropdown!']);
        }
    }
}
