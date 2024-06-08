<?php

namespace App\Http\Controllers;

use App\Models\Classification;
use App\Models\Dropdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use DateTime;

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
        // Initiate Variable Filter
        $out_date = $request->get('out_date');
        $mail_date = $request->get('mail_date');
        $mail_number = $request->get('mail_number');
        $id_mst_letter = $request->get('id_mst_letter');
        $archive_remains = $request->get('archive_remains');

        $letters = Letter::get();
        
        $datas = OutgoingMail::select('outgoing_mails.*', 'outgoing_mails.updated_at as last_update', 'draft.work_name as drafter_name', 'master_letter.let_name')
            ->leftjoin('master_workunit as draft', 'draft.id', 'outgoing_mails.drafter')
            ->leftjoin('master_letter', 'master_letter.id', 'outgoing_mails.id_mst_letter')
            ->orderBy('created_at', 'desc');

        // FIlter
        if ($out_date != null) {
            $datas->where('outgoing_mails.out_date', 'like', '%' . $out_date . '%');
        }
        if ($mail_date != null) {
            $datas->where('outgoing_mails.mail_date', 'like', '%' . $mail_date . '%');
        }
        if ($mail_number != null) {
            $datas->where('outgoing_mails.mail_number', 'like', '%' . $mail_number . '%');
        }
        if ($id_mst_letter != null) {
            $datas->where('id_mst_letter', $id_mst_letter);
        }
        if ($archive_remains != null) {
            $datas->where('outgoing_mails.archive_remains', $archive_remains);
        }
    
        // Get Query
        $datas = $datas->get();

        function cleanText($text) {
            $text = strip_tags($text);
            $text = str_replace('&nbsp;', ' ', $text);
            return $text;
        }
        $datas = $datas->map(function($item) {
            $item->mail_regarding_filtered = cleanText($item->mail_regarding);
            return $item;
        });

        if ($request->ajax()) {
            $data = DataTables::of($datas)
            ->addColumn('action', function ($data) {
                return view('mail.outgoing.action', compact('data'));
            })
            ->toJson();
            return $data;
        }

        return view('mail.outgoing.index', compact('letters', 'datas', 'out_date', 'mail_date', 'mail_number', 'id_mst_letter', 'archive_remains'));
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

    public function storebulk(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "id_mst_letter" => "required",
            "amount_letter" => "required",
        ], [
            'id_mst_letter.required' => 'Jenis Naskah Wajib Untuk Diisi.',
            'amount_letter.required' => 'Jumlah Naskah Wajib Untuk Diisi.',
        ]);

        $idMstLetter = $request->id_mst_letter;
        $amountLetter = $request->amount_letter;
        
        DB::beginTransaction();
        try {
            for ($i = 0; $i < $amountLetter; $i++) {
                // Store Outgoing Mail
                $store = OutgoingMail::create([
                    'id_mst_letter' => $idMstLetter,
                    'status' => null,
                    'created_by' => auth()->user()->email,
                ]);
                // Register Que
                QueNumbOutMail::create([
                    'id_mail' => $store->id,
                    'id_mst_letter' => $idMstLetter
                ]);
            }

            DB::commit();
            return redirect()->route('outgoingmail.index')->with(['success' => 'Sukses Tambah Data (Bulk) Dengan Jumlah : '.$amountLetter.'']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data (Bulk)!']);
        }
    }

    public function detail($id)
    {
        $id = decrypt($id);
        // dd($id);

        $data = OutgoingMail::select('outgoing_mails.*', 'master_letter.let_name', 'draft.work_name as drafter_name', 'org.sator_name',
            'sign.work_name as sign_name', 'master_unit_letter.unit_name', 'master_classification.classification_name'
        )
            ->leftjoin('master_letter', 'master_letter.id', 'outgoing_mails.id_mst_letter')
            ->leftjoin('master_workunit as draft', 'draft.id', 'outgoing_mails.drafter')
            ->leftjoin('master_sator as org', 'org.id', 'outgoing_mails.org_unit')
            ->leftjoin('master_workunit as sign', 'sign.id', 'outgoing_mails.signing')
            ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'outgoing_mails.mail_unit')
            ->leftjoin('master_classification', 'master_classification.id', 'outgoing_mails.archive_classification')
            ->where('outgoing_mails.id', $id)
            ->first();

        return view('mail.outgoing.info', compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);

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

        $data = OutgoingMail::select('outgoing_mails.*', 'master_letter.let_name')
            ->leftjoin('master_letter', 'master_letter.id', 'outgoing_mails.id_mst_letter')
            ->where('outgoing_mails.id', $id)
            ->first();

        return view('mail.outgoing.edit', compact('letters', 'workunits', 'sators', 'unitletters', 'classifications', 'receivedvias',
            'sators', 'data'));
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
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

        $out_date = (new DateTime($request->out_date))->format('Y-m-d H:i:s');
        $mail_date = (new DateTime($request->mail_date))->format('Y-m-d H:i:s');
        $mail_retention_from = (new DateTime($request->mail_retention_from))->format('Y-m-d H:i:s');
        $mail_retention_to = (new DateTime($request->mail_retention_to))->format('Y-m-d H:i:s');
        $location_save_route = [
            'idGedung' => $request->input('namaGedung'),
            'idLantai' => $request->input('namaLantai'),
            'idRuang' => $request->input('namaRuang'),
            'idRak' => $request->input('namaRak'),
            'idBaris' => $request->input('namaBaris'),
            'idKolom' => $request->input('namaKolom'),
            'idBoks' => $request->input('namaBoks'),
        ];
        $location_save_route = json_encode($location_save_route);    

        // Check With Data Before
        $databefore = OutgoingMail::where('id', $id)->first();

        $databefore->id_mst_letter = $request->id_mst_letter;
        $databefore->drafter = $request->drafter;
        $databefore->org_unit = $request->org_unit;
        $databefore->mail_regarding = $request->mail_regarding;
        $databefore->out_date = $out_date;
        $databefore->mail_date = $mail_date;
        $databefore->signing = $request->signing;
        $databefore->signing_other = $request->signing_other;
        $databefore->receiver = $request->receiver;
        $databefore->mail_quantity = $request->mail_quantity;
        $databefore->mail_unit = $request->mail_unit;
        $databefore->archive_remains = $request->archive_remain;
        $databefore->archive_classification = $request->archive_classification;
        $databefore->mail_retention_from = $mail_retention_from;
        $databefore->mail_retention_to = $mail_retention_to;
        $databefore->location_save = $request->save_location;
        if($databefore->location_save != $request->save_location){
            $databefore->location_save_route = $location_save_route;
            $newroute = $location_save_route;
        } else {
            $newroute = $databefore->location_save_route;
        }
        $databefore->received_via = $request->received_via;
        $databefore->ref_number = $request->ref_number;
        $databefore->ref_mail = $request->mail_ref;
        $databefore->attachment_text = $request->attachment_text;
        $databefore->information = $request->information;

        if($databefore->isDirty()){
            DB::beginTransaction();
            try {
                // Update Outgoing Mail
                OutgoingMail::where('id', $id)->update([
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
                    'updated_by' => auth()->user()->email,
                ]);
    
                DB::commit();
                return redirect()->route('outgoingmail.index')->with(['success' => 'Sukses Ubah Data']);
            } catch (Throwable $th) {
                DB::rollback();
                return redirect()->back()->with(['fail' => 'Gagal Ubah Data!']);
            }
        }
        else {
            return redirect()->route('outgoingmail.index')->with(['info' => 'Tidak ada perubahan, data sama dengan yang sebelumnya']);
        }
    }
}
