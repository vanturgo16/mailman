<?php

namespace App\Http\Controllers;

use App\Models\Dropdown;
use App\Models\Letter;
use App\Models\Pattern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LetterController extends Controller
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
        $datas = Letter::select('master_letter.*','master_pattern.pat_type')
        ->leftJoin('master_pattern','master_letter.id','master_pattern.let_id')
        ->orderBy('let_code','asc')
        ->orderBy('let_name','asc')->get();
        $dropdowns = Dropdown::where('category','Tipe Penomoran')->orderBy('name_value','asc')->get();
        $strucNos  = Dropdown::where('category','Struktur Nomor')->orderBy('name_value','asc')->get();
        return view('parameter.naskah.index',compact('datas','dropdowns','strucNos'));
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
            "kode_naskah" => "required",
            "nama_naskah" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Letter::create([
                'let_code' => $request->kode_naskah,
                'let_name' => $request->nama_naskah,
                'let_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data Naskah Dinas']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data Naskah Dinas!']);
        }
    }

    public function createPattern($id){
        $data = Letter::where('master_letter.id',decrypt($id))
            ->select(
                'master_letter.let_name',
                'master_letter.let_code',
                'master_pattern.*'
            )
            ->leftJoin('master_pattern','master_letter.id','master_pattern.let_id')
            ->first();
        $dropdowns = Dropdown::where('category','Tipe Penomoran')->orderBy('name_value','asc')->get();
        $strucNos  = Dropdown::where('category','Struktur Nomor')->orderBy('name_value','asc')->get();
        return view('parameter.naskah.create_pattern',compact('data','dropdowns','strucNos','id'));
    }

    public function storePattern(Request $request){
        //dd($request->all(),$request->pat_mix,json_encode($request->pat_mix));

        $request->validate([
            "kode_naskah" => "required",
            "nama_naskah" => "required",
            "kategori" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            //cek dulu sdh ada atau belum pattern nya
            $check = Pattern::where('let_id',$request->let_id)->count();

            if($check > 0){
                if ($request->kategori == "Sederhana") {
                    $store = Pattern::where('let_id',$request->let_id)->update([
                        'let_id' => $request->let_id,
                        'pat_simple' => $request->pat_simple,
                        'pat_type' => $request->kategori,
                        'created_by' => $user,
                    ]);                
                }
                elseif($request->kategori == "Perpaduan"){
                    $store = Pattern::where('let_id',$request->let_id)->update([
                        'let_id' => $request->let_id,
                        'pat_mix' => json_encode($request->pat_mix),
                        'pat_type' => $request->kategori,
                        'created_by' => $user,
                    ]); 
                }
                else{
                    $store = Pattern::where('let_id',$request->let_id)->update([
                        'let_id' => $request->let_id,
                        'pat_type' => $request->kategori,
                        'created_by' => $user,
                    ]);
                }
            }
            else{
                if ($request->kategori == "Sederhana") {
                    $store = Pattern::create([
                        'let_id' => $request->let_id,
                        'pat_simple' => $request->pat_simple,
                        'pat_type' => $request->kategori,
                        'created_by' => $user,
                    ]);                
                }
                elseif($request->kategori == "Perpaduan"){
                    $store = Pattern::create([
                        'let_id' => $request->let_id,
                        'pat_mix' => json_encode($request->pat_mix),
                        'pat_type' => $request->kategori,
                        'created_by' => $user,
                    ]); 
                }
                else{
                    $store = Pattern::create([
                        'let_id' => $request->let_id,
                        'pat_type' => $request->kategori,
                        'created_by' => $user,
                    ]);
                }
            }

            DB::commit();
            return redirect('/naskah')->with(['success' => 'Sukses Tambah Struktur Penomoran Surat Keluar']);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect('/naskah')->with(['fail' => 'Gagal Tambah Struktur Penomoran Surat Keluar!']);
        }
    }

    public function update(Request $request, $id)
    {
        //dd($id);
        $request->validate([
            "kode_naskah" => "required",
            "nama_naskah" => "required",
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Letter::where('id',$id)
            ->update([
                'let_code' => $request->kode_naskah,
                'let_name' => $request->nama_naskah,
                'let_desc' => $request->keterangan,
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Naskah Dinas']);
        } catch (\Throwable $th) {
            //dd($th);
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Naskah Dinas!']);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Letter::where('id',$id)
            ->update([
                'is_active' => '0',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Naskah Dinas']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Naskah Dinas!']);
        }
    }

    public function aktif($id){
        //dd($id);
        DB::beginTransaction();
        try {
            $user = auth()->user()->email;
            $store = Letter::where('id',decrypt($id))
            ->update([
                'is_active' => '1',
                'created_by' => $user,
            ]);

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Ubah Data Naskah Dinas']);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data Naskah Dinas!']);
        }
    }
}
