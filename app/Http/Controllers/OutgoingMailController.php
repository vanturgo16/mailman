<?php

namespace App\Http\Controllers;

use App\Models\Classification;
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

class OutgoingMailController extends Controller
{
    public function index(Request $request)
    {
        $datas = IncommingMail::orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            $data = DataTables::of($datas)
            ->addColumn('action', function ($data) {
                return view('mail.outgoing.action', compact('data'));
            })
            ->toJson();
            return $data;
        }

        return view('mail.outgoing.index', compact('datas'));
    }

    public function create(Request $request)
    {
        $letters = Letter::get();
        $workunits = WorkUnit::get();
        $sators = Sator::get();
        $unitletters = UnitLetter::get();
        $classifications = Classification::get();
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();

        $sators = Sator::orderBy('sator_name','asc')->get();

        return view('mail.outgoing.create', compact('letters', 'workunits', 'sators', 'unitletters', 'classifications', 'receivedvias',
            'sators'));
    }

    public function store(Request $request)
    {
        //dd('hai');
        $request->validate([
            "kode_unit" => "required",
        ]);

        DB::beginTransaction();
        try {

            DB::commit();
            return redirect()->back()->with(['success' => 'Sukses Tambah Data']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data!']);
        }
    }
}
