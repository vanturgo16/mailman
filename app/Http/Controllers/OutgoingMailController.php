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
use App\Models\OutgoingMail;
use App\Models\QueNumbOutMail;
use App\Models\Sator;
use App\Models\UnitLetter;
use App\Models\WorkUnit;

class OutgoingMailController extends Controller
{
    public function index(Request $request)
    {
        $datas = OutgoingMail::select('outgoing_mails.*', 'draft.work_name as drafter_name')
            ->leftjoin('master_workunit as draft', 'draft.id', 'outgoing_mails.drafter')
            ->orderBy('created_at', 'desc')
            ->get();

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

        $datas = IncommingMail::orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            $data = DataTables::of($datas)
            ->addColumn('action', function ($data) {
                return view('mail.outgoing.action-select', compact('data'));
            })
            ->toJson();
            return $data;
        }

        return view('mail.outgoing.create', compact('letters', 'workunits', 'sators', 'unitletters', 'classifications', 'receivedvias',
            'sators'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "id_mst_letter" => "required",
            "drafter" => "required",
            "mail_regarding" => "required",
            "out_date" => "required",
            "mail_date" => "required",
            "signing" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
            "archive_remain" => "required",
        ], [
            'id_mst_letter.required' => 'Jenis Naskah Wajib Untuk Diisi.',
            'drafter.required' => 'Konseptor Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'out_date.required' => 'Tanggal Keluar Wajib Untuk Diisi.',
            'mail_date.required' => 'Tanggal Surat Wajib Untuk Diisi.',
            'signing.required' => 'Penandatanganan Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
            'archive_remain.required' => 'Arsip Pertinggal Wajib Untuk Diisi.',
        ]);
        
        DB::beginTransaction();
        try {
            if($request->save_location != null){
                $location_save_route = json_encode([
                    'idGedung' => $request->input('namaGedung'),
                    'idLantai' => $request->input('namaLantai'),
                    'idRuang' => $request->input('namaRuang'),
                    'idRak' => $request->input('namaRak'),
                    'idBaris' => $request->input('namaBaris'),
                    'idKolom' => $request->input('namaKolom'),
                    'idBoks' => $request->input('namaBoks'),
                ]);
            } else {
                $location_save_route = null;
            }

            // Store Outgoing Mail
            $store = OutgoingMail::create([
                'id_mst_letter' => $request->id_mst_letter,
                'drafter' => $request->drafter,
                'org_unit' => $request->org_unit,
                'mail_regarding' => $request->mail_regarding,
                'out_date' => $request->out_date,
                'mail_date' => $request->mail_date,
                'signing' => $request->signing,
                'signing_other' => $request->signing_other,
                'receiver' => $request->receiver,
                'mail_quantity' => $request->mail_quantity,
                'mail_unit' => $request->mail_unit,
                'archive_remains' => $request->archive_remain,
                'archive_classification' => $request->archive_classification,
                'mail_retention_from' => $request->mail_retention_from,
                'mail_retention_to' => $request->mail_retention_to,
                'location_save' => $request->save_location,
                'location_save_route' => $location_save_route,
                'received_via' => $request->received_via,
                'attachment_text' => $request->attachment_text,
                'ref_number' => $request->ref_number,
                'ref_mail' => $request->mail_ref,
                'information' => $request->information,
                'status' => null,
                'created_by' => auth()->user()->email,
            ]);

            // Register Que
            QueNumbOutMail::create([
                'id_mail' => $store->id,
                'id_mst_letter' => $request->id_mst_letter
            ]);

            DB::commit();
            return redirect()->route('outgoingmail.index')->with(['success' => 'Sukses Tambah Data']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data!']);
        }
    }
}
