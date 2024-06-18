<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Complain;
use App\Models\Dropdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

// Model
use App\Models\IncommingMail;
use App\Models\Letter;
use App\Models\Sator;
use App\Models\UnitLetter;
use App\Models\WorkUnit;

class IncommingMailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(['permission:surat_masuk']);
    } 
    
    public function index(Request $request)
    {
        $datas = IncommingMail::select('incomming_mails.*', 'incomming_mails.updated_at as last_update', 'incomming_mails.created_at as created')
            ->orderBy('created_at', 'desc');

        // Get Query
        $datas = $datas->get();
        // dd($datas);

        if ($request->ajax()) {
            $data = DataTables::of($datas)
            ->addColumn('action', function ($data) {
                return view('mail.incomming.action', compact('data'));
            })
            ->toJson();
            return $data;
        }

        return view('mail.incomming.index', compact('datas'));
    }

    // public function index(Request $request)
    // {
    //     return view('mail.incomming.cs');
    // }

    public function create(Request $request)
    {
        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $complains = Complain::get();
        $letters = Letter::get();
        $workunits = WorkUnit::get();
        $unitletters = UnitLetter::get();
        $classifications = Classification::get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();
        $mailtypes = Dropdown::where('category', 'Jenis Surat')->get();
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();

        $sators = Sator::orderBy('sator_name','asc')->get();

        return view('mail.incomming.create', compact('placemans', 'complains', 'letters', 'workunits', 'unitletters', 'classifications', 'results', 'approveds', 'mailtypes', 'receivedvias',
            'sators'));
    }

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
    
    public function show(WorkUnit $workUnit)
    {
        //
    }
    
    public function edit(WorkUnit $workUnit)
    {
        //
    }
    
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
