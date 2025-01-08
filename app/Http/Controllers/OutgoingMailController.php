<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use DateTime;
use PDF;
use Carbon\Carbon;

// Model
use App\Models\IncommingMail;
use App\Models\Letter;
use App\Models\OutgoingMail;
use App\Models\QueNumbOutMail;
use App\Models\Sator;
use App\Models\UnitLetter;
use App\Models\WorkUnit;
use App\Models\Classification;
use App\Models\Dropdown;
use App\Models\DaftarGedung;
use App\Models\DaftarBaris;
use App\Models\DaftarBox;
use App\Models\DaftarKolom;
use App\Models\DaftarLantai;
use App\Models\DaftarRak;
use App\Models\DaftarRuang;
use App\Models\KkaCode;
use App\Models\KkaType;
use App\Models\LastNumberingOutgoing;
use App\Models\Pattern;
use App\Models\SubSator;
use Hamcrest\Arrays\IsArray;

class OutgoingMailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:surat_keluar']);
    }

    public function cleanText($text)
    {
        $text = strip_tags($text);
        $text = str_replace('&nbsp;', ' ', $text);
        return $text;
    }

    public function index(Request $request)
    {
        // Initiate Variable Filter
        $out_date = $request->get('out_date');
        $mail_date = $request->get('mail_date');
        $mail_number = $request->get('mail_number');
        $id_mst_letter = $request->get('id_mst_letter');
        $archive_remain = $request->get('archive_remain');
        $org_unit = $request->get('org_unit');
        $jmlHal = $request->get('jmlHal');

        $workunits = WorkUnit::get();

        $letters = Letter::get();
        $sators = Sator::orderBy('sator_name', 'asc')->get();
        $archive_remains = Dropdown::where('category', 'Arsip Pertinggal')->get();
        $jmlHals = Dropdown::where('category', 'Jumlah Halaman')->get();

        $datas = OutgoingMail::select(
            'outgoing_mails.*',
            'outgoing_mails.updated_at as last_update',
            'outgoing_mails.created_at as created',
            'master_letter.let_name',
            'master_unit_letter.unit_name',
            'master_sub_sator.sub_sator_name'
        )
            ->leftjoin('master_sub_sator', 'outgoing_mails.sub_org_unit', 'master_sub_sator.id')
            ->leftjoin('master_unit_letter', 'outgoing_mails.mail_unit', 'master_unit_letter.id')
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
        if ($archive_remain != null) {
            $datas->where('outgoing_mails.archive_remains', $archive_remain);
        }
        if ($org_unit != null) {
            $datas->where('org_unit', $org_unit);
        }
        if ($jmlHal != null) {
            if ($jmlHal == '1-3') {
                $datas->whereBetween('outgoing_mails.jml_hal', [1, 3]);
            } elseif ($jmlHal == '4-20') {
                $datas->whereBetween('outgoing_mails.jml_hal', [4, 20]);
            } else {
                $datas->where('outgoing_mails.jml_hal', '>', 20);
            }
        }

        // Get Query
        // $datas = $datas->take(3)->get();

        $datas = $datas->get();
        $lastUpdated = $datas->isNotEmpty() ? $datas->max('updated_at')->toDateTimeString() : null;

        // $datas = $datas->map(function($item) {
        //     $item->mail_regarding_filtered = $this->cleanText($item->mail_regarding);
        //     return $item;
        // });

        if ($request->ajax()) {
            $data = DataTables::of($datas)
                ->addColumn('action', function ($data) {
                    return view('mail.outgoing.action', compact('data'));
                })
                ->toJson();
            return $data;
        }

        return view('mail.outgoing.index', compact(
            'workunits',
            'letters',
            'sators',
            'archive_remains',
            'datas',
            'out_date',
            'mail_date',
            'mail_number',
            'id_mst_letter',
            'archive_remain',
            'org_unit',
            'jmlHal',
            'jmlHals',
            'lastUpdated'
        ));
    }

    public function directupdate(Request $request, $id)
    {
        $id = $id;

        // Check With Data Before
        $databefore = OutgoingMail::where('id', $id)->first();
        // $databefore->mail_number = $request[2];
        $databefore->receiver = $request[3];
        $databefore->mail_regarding = $request[4];
        // $databefore->drafter = $request[5];
        $databefore->mail_quantity = $request[6];
        $databefore->attachment_text = $request[7];
        $databefore->information = $request[8];

        if ($databefore->isDirty()) {
            DB::beginTransaction();

            // if($request[5] != null){
            //     $jmlHal = $databefore->mail_quantity + $request[5];
            // } else {
            //     $jmlHal = $databefore->mail_quantity;
            // }

            try {
                // Update Outgoing Mail
                OutgoingMail::where('id', $id)->update([
                    // 'mail_number' => $request[2],
                    // 'drafter' => $request[6],
                    'receiver' => $request[3],
                    'mail_regarding' => $request[4],
                    // 'attachment_text' => $request[5],
                    // 'jml_hal' => $jmlHal,
                    'mail_quantity' => $request[6],
                    'attachment_text' => $request[7],
                    'information' => $request[8],
                    'updated_by' => auth()->user()->name,
                ]);

                DB::commit();
                return response()->json(['success' => true]);
            } catch (Throwable $th) {
                DB::rollback();
                return response()->json(['success' => false]);
            }
        } else {
            return response()->json(['success' => "Same"]);
        }
    }

    public function checkChanges()
    {
        $firstque = QueNumbOutMail::count();
        sleep(3);
        $secondque = QueNumbOutMail::count();
        $changes = ($firstque != $secondque);

        return response()->json(['changes' => $changes]);
    }
    public function checkChangeUpdate()
    {
        $firstTimestamp = OutgoingMail::max('updated_at');
        sleep(3);
        $secondTimestamp = OutgoingMail::max('updated_at');
        $changes = ($firstTimestamp != $secondTimestamp);

        return response()->json(['changes' => $changes]);
    }
    public function checkChangeOutgoing(Request $request)
    {
        $lastUpdated = $request->input('lastUpdated');
        $datas = OutgoingMail::get();
        $lastUpdatedNow = $datas->isNotEmpty() ? $datas->max('updated_at')->toDateTimeString() : null;
        $changes = ($lastUpdated != $lastUpdatedNow);

        return response()->json([
            'changes' => $changes,
            'lastUpdatedNow' => $lastUpdatedNow,
        ]);
    }
    public function mapKka($id)
    {
        $kkaCodes = KkaCode::where('id_kka_type', $id)->get();
        return $kkaCodes;
    }
    public function checkNumberingKka($id)
    {
        $pattern = Pattern::where('let_id', $id)
            ->where('pat_mix', 'like', '%Kode Klasifikasi Arsip (KKA)%')
            ->exists();
        return response()->json($pattern);
    }

    public function rekapitulasi(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $mail_number = $request->get('mail_number');
        $drafter = $request->get('drafter');
        $id_mst_letter = $request->get('id_mst_letter');
        $workunit = $request->get('workunit');
        $archive_remain = $request->get('archive_remain');

        $letters = Letter::get();
        $workunits = WorkUnit::get();
        $sators = Sator::orderBy('sator_name', 'asc')->get();
        $archive_remains = Dropdown::where('category', 'Arsip Pertinggal')->get();

        if (isset($startdate) || isset($enddate) || isset($drafter) || isset($mail_number) || isset($id_mst_letter) || isset($workunit) || isset($archive_remain)) {
            $datas = OutgoingMail::select('outgoing_mails.*', 'outgoing_mails.updated_at as last_update', 'master_unit_letter.unit_name', 'signer.work_name as signer', 'master_sub_sator.sub_sator_name')
                ->leftjoin('master_sub_sator', 'outgoing_mails.sub_org_unit', 'master_sub_sator.id')
                ->leftjoin('master_workunit as signer', 'signer.id', 'outgoing_mails.signing')
                ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'outgoing_mails.mail_unit')
                ->orderBy('created_at', 'desc');

            // Filter
            if ($startdate != null) {
                $datas->where(function ($query) use ($startdate) {
                    $query->where('outgoing_mails.mail_date', '>=', $startdate)
                        ->orWhere('outgoing_mails.out_date', '>=', $startdate);
                });
            }
            if ($enddate != null) {
                $datas->where(function ($query) use ($enddate) {
                    $query->where('outgoing_mails.mail_date', '<=', $enddate)
                        ->orWhere('outgoing_mails.out_date', '<=', $enddate);
                });
            }
            if ($drafter != null) {
                $datas->where('outgoing_mails.org_unit', $drafter);
            }
            if ($mail_number != null) {
                $datas->where('outgoing_mails.mail_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('outgoing_mails.mail_regarding', 'like', '%' . $mail_number . '%');
            }
            if ($id_mst_letter != null) {
                $datas->where('outgoing_mails.id_mst_letter', $id_mst_letter);
            }
            if ($workunit != null) {
                $datas->where('outgoing_mails.signing', $workunit);
            }
            if ($archive_remain != null) {
                $datas->where('outgoing_mails.archive_remain', $archive_remain);
            }

            // Get Query
            $datas = $datas->get();

            // $datas = $datas->map(function($item) {
            //     $item->mail_regarding_filtered = $this->cleanText($item->mail_regarding);
            //     return $item;
            // });

            // $datas = $datas->map(function($item) {
            //     $item->attachment_text_filtered = $this->cleanText($item->attachment_text);
            //     return $item;
            // });

            // $datas = $datas->map(function($item) {
            //     $item->information_filtered = $this->cleanText($item->information);
            //     return $item;
            // });
        } else {
            $datas = [];
        }

        if ($request->ajax()) {
            $data = DataTables::of($datas)->toJson();
            return $data;
        }

        return view('mail.outgoing.rekapitulasi', compact(
            'letters',
            'sators',
            'workunits',
            'archive_remains',
            'datas',
            'startdate',
            'enddate',
            'drafter',
            'mail_number',
            'id_mst_letter',
            'workunit',
            'archive_remain'
        ));
    }

    public function rekapitulasiPrint(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $drafter = $request->get('drafter');
        $mail_number = $request->get('mail_number');
        $id_mst_letter = $request->get('id_mst_letter');
        $workunit = $request->get('workunits');
        $archive_remain = $request->get('archive_remain');

        if (isset($startdate) || isset($enddate) || isset($drafter) || isset($mail_number) || isset($id_mst_letter) || isset($workunit) || isset($archive_remain)) {
            $datas = OutgoingMail::select('outgoing_mails.*', 'outgoing_mails.updated_at as last_update', 'master_unit_letter.unit_name', 'signer.work_name as signer', 'master_sub_sator.sub_sator_name')
                ->leftjoin('master_sub_sator', 'outgoing_mails.sub_org_unit', 'master_sub_sator.id')
                ->leftjoin('master_workunit as signer', 'signer.id', 'outgoing_mails.signing')
                ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'outgoing_mails.mail_unit')
                ->orderBy('created_at', 'desc');

            // Filter
            if ($startdate != null) {
                $datas->where(function ($query) use ($startdate) {
                    $query->where('outgoing_mails.mail_date', '>=', $startdate)
                        ->orWhere('outgoing_mails.out_date', '>=', $startdate);
                });
            }
            if ($enddate != null) {
                $datas->where(function ($query) use ($enddate) {
                    $query->where('outgoing_mails.mail_date', '<=', $enddate)
                        ->orWhere('outgoing_mails.out_date', '<=', $enddate);
                });
            }
            if ($drafter != null) {
                $datas->where('outgoing_mails.org_unit', $drafter);
            }
            if ($mail_number != null) {
                $datas->where('outgoing_mails.mail_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('outgoing_mails.mail_regarding', 'like', '%' . $mail_number . '%');
            }
            if ($id_mst_letter != null) {
                $datas->where('outgoing_mails.id_mst_letter', $id_mst_letter);
            }
            if ($workunit != null) {
                $datas->where('outgoing_mails.signing', $workunit);
            }
            if ($archive_remain != null) {
                $datas->where('outgoing_mails.archive_remain', $archive_remain);
            }

            // Get Query
            $datas = $datas->get();

            // $datas = $datas->map(function($item) {
            //     $item->mail_regarding_filtered = $this->cleanText($item->mail_regarding);
            //     return $item;
            // });

            // $datas = $datas->map(function($item) {
            //     $item->attachment_text_filtered = $this->cleanText($item->attachment_text);
            //     return $item;
            // });

            // $datas = $datas->map(function($item) {
            //     $item->information_filtered = $this->cleanText($item->information);
            //     return $item;
            // });
        } else {
            $datas = [];
        }

        $now = Carbon::now()->format('YmdHis');

        if ($id_mst_letter != null) {
            $letter = Letter::where('id', $id_mst_letter)->first()->let_name;
        } else {
            $letter = null;
        }

        $pdf = PDF::loadView('pdf.rekapitulasi', [
            'startdate' => $startdate,
            'enddate' => $enddate,
            'print_date' => $now,
            'letter' => $letter,
            'user' => auth()->user()->name,
            'datas' => $datas,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Print Rekapitulasi.pdf', array("Attachment" => false));
    }

    public function create(Request $request)
    {
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();
        $archive_remains = Dropdown::where('category', 'Arsip Pertinggal')->get();

        $letters = Letter::where('is_active', 1)->get();
        $workunits = WorkUnit::where('is_active', 1)->get();
        $sators = Sator::where('is_active', 1)->get();
        $unitletters = UnitLetter::whereIn('category', ['2', '3'])->where('is_active', 1)->get(); // Surat Keluar Kategori 2 & 3
        $classifications = Classification::where('is_active', 1)->get();
        $gedungs = DaftarGedung::where('is_active', 1)->get();
        $sators = Sator::orderBy('sator_name', 'asc')->where('is_active', 1)->get();
        $kkaTypes = KkaType::where('is_active', 1)->get();

        $datas = IncommingMail::orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            $data = DataTables::of($datas)
                ->addColumn('action', function ($data) {
                    return view('mail.outgoing.action-select', compact('data'));
                })
                ->toJson();
            return $data;
        }

        return view('mail.outgoing.create', compact(
            'letters',
            'workunits',
            'sators',
            'unitletters',
            'classifications',
            'receivedvias',
            'sators',
            'archive_remains',
            'gedungs',
            'kkaTypes'
        ));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "id_mst_letter" => "required",
            // "drafter" => "required",
            "mail_regarding" => "required",
            "out_date" => "required",
            "signing" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
            "archive_remain" => "required",
        ], [
            'id_mst_letter.required' => 'Jenis Naskah Wajib Untuk Diisi.',
            // 'drafter.required' => 'Konseptor Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'out_date.required' => 'Tanggal Keluar Wajib Untuk Diisi.',
            'signing.required' => 'Penandatanganan Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
            'archive_remain.required' => 'Arsip Pertinggal Wajib Untuk Diisi.',
        ]);

        DB::beginTransaction();
        try {
            // if($request->save_location != null){
            //     $location_save_route = json_encode([
            //         'idGedung' => $request->input('namaGedung'),
            //         'idLantai' => $request->input('namaLantai'),
            //         'idRuang' => $request->input('namaRuang'),
            //         'idRak' => $request->input('namaRak'),
            //         'idBaris' => $request->input('namaBaris'),
            //         'idKolom' => $request->input('namaKolom'),
            //         'idBoks' => $request->input('namaBoks'),
            //     ]);
            // } else {
            //     $location_save_route = json_encode([
            //         'idGedung' => null,
            //         'idLantai' => null,
            //         'idRuang' => null,
            //         'idRak' => null,
            //         'idBaris' => null,
            //         'idKolom' => null,
            //         'idBoks' => null,
            //     ]);
            // }

            // if($request->attachment_text != null){
            //     $jmlHal = $request->mail_quantity + $request->attachment_text;
            // } else {
            //     $jmlHal = $request->mail_quantity;
            // }

            // Store Outgoing Mail
            $store = OutgoingMail::create([
                'id_mst_letter' => $request->id_mst_letter,
                'kka_type' => $request->kka_type,
                'kka_code' => $request->kka_code,
                // 'drafter' => $request->drafter,
                'org_unit' => $request->org_unit,
                'sub_org_unit' => $request->sub_org_unit,
                'mail_regarding' => $request->mail_regarding,
                'out_date' => $request->out_date,
                'mail_date' => $request->mail_date,
                'signing' => $request->signing,
                'signing_other' => $request->signing_other,
                'receiver' => $request->receiver,
                'mail_quantity' => $request->mail_quantity,
                'mail_unit' => $request->mail_unit,
                'archive_remains' => $request->archive_remain,
                // 'archive_classification' => $request->archive_classification,
                // 'mail_retention_from' => $request->mail_retention_from,
                // 'mail_retention_to' => $request->mail_retention_to,
                // 'location_save' => $request->save_location,
                // 'location_save_route' => $location_save_route,
                // 'received_via' => $request->received_via,
                'attachment_text' => $request->attachment_text,
                // 'ref_number' => $request->ref_number,
                // 'ref_mail' => $request->mail_ref,
                'information' => $request->information,
                // 'jml_hal' => $jmlHal,
                'status' => null,
                'created_by' => auth()->user()->name,
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

    public function createbulk(Request $request)
    {
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();
        $archive_remains = Dropdown::where('category', 'Arsip Pertinggal')->get();

        $letters = Letter::where('is_active', 1)->get();
        $workunits = WorkUnit::where('is_active', 1)->get();
        $sators = Sator::where('is_active', 1)->get();
        $unitletters = UnitLetter::whereIn('category', ['2', '3'])->where('is_active', 1)->get(); // Surat Keluar Kategori 2 & 3
        $classifications = Classification::where('is_active', 1)->get();
        $gedungs = DaftarGedung::where('is_active', 1)->get();
        $sators = Sator::orderBy('sator_name', 'asc')->where('is_active', 1)->get();
        $kkaTypes = KkaType::where('is_active', 1)->get();

        $datas = IncommingMail::orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            $data = DataTables::of($datas)
                ->addColumn('action', function ($data) {
                    return view('mail.outgoing.action-select', compact('data'));
                })
                ->toJson();
            return $data;
        }

        return view('mail.outgoing.createbulk', compact(
            'letters',
            'workunits',
            'sators',
            'unitletters',
            'classifications',
            'receivedvias',
            'sators',
            'archive_remains',
            'gedungs',
            'kkaTypes'
        ));
    }
    public function storebulk(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "id_mst_letter" => "required",
            // "drafter" => "required",
            "mail_regarding" => "required",
            "out_date" => "required",
            "signing" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
            "archive_remain" => "required",
        ], [
            'id_mst_letter.required' => 'Jenis Naskah Wajib Untuk Diisi.',
            // 'drafter.required' => 'Konseptor Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'out_date.required' => 'Tanggal Keluar Wajib Untuk Diisi.',
            'signing.required' => 'Penandatanganan Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
            'archive_remain.required' => 'Arsip Pertinggal Wajib Untuk Diisi.',
        ]);

        $amountLetter = $request->amount_letter;

        DB::beginTransaction();
        try {
            // if($request->save_location != null){
            //     $location_save_route = json_encode([
            //         'idGedung' => $request->input('namaGedung'),
            //         'idLantai' => $request->input('namaLantai'),
            //         'idRuang' => $request->input('namaRuang'),
            //         'idRak' => $request->input('namaRak'),
            //         'idBaris' => $request->input('namaBaris'),
            //         'idKolom' => $request->input('namaKolom'),
            //         'idBoks' => $request->input('namaBoks'),
            //     ]);
            // } else {
            //     $location_save_route = json_encode([
            //         'idGedung' => null,
            //         'idLantai' => null,
            //         'idRuang' => null,
            //         'idRak' => null,
            //         'idBaris' => null,
            //         'idKolom' => null,
            //         'idBoks' => null,
            //     ]);
            // }

            // if($request->attachment_text != null){
            //     $jmlHal = $request->mail_quantity + $request->attachment_text;
            // } else {
            //     $jmlHal = $request->mail_quantity;
            // }

            for ($i = 0; $i < $amountLetter; $i++) {

                // Store Outgoing Mail
                $store = OutgoingMail::create([
                    'id_mst_letter' => $request->id_mst_letter,
                    'kka_type' => $request->kka_type,
                    'kka_code' => $request->kka_code,
                    // 'drafter' => $request->drafter,
                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'mail_regarding' => $request->mail_regarding,
                    'out_date' => $request->out_date,
                    'mail_date' => $request->mail_date,
                    'signing' => $request->signing,
                    'signing_other' => $request->signing_other,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    'archive_remains' => $request->archive_remain,
                    // 'archive_classification' => $request->archive_classification,
                    // 'mail_retention_from' => $request->mail_retention_from,
                    // 'mail_retention_to' => $request->mail_retention_to,
                    // 'location_save' => $request->save_location,
                    // 'location_save_route' => $location_save_route,
                    // 'received_via' => $request->received_via,
                    'attachment_text' => $request->attachment_text,
                    // 'ref_number' => $request->ref_number,
                    // 'ref_mail' => $request->mail_ref,
                    'information' => $request->information,
                    // 'jml_hal' => $jmlHal,
                    'status' => null,
                    'created_by' => auth()->user()->name,
                ]);

                // Register Que
                QueNumbOutMail::create([
                    'id_mail' => $store->id,
                    'id_mst_letter' => $request->id_mst_letter
                ]);
            }

            DB::commit();
            return redirect()->route('outgoingmail.index')->with(['success' => 'Sukses Tambah Data (Bulk) Dengan Jumlah : ' . $amountLetter . '']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data (Bulk)!']);
        }
    }

    public function detail($id)
    {
        $id = decrypt($id);
        // dd($id);

        $data = OutgoingMail::select(
            'outgoing_mails.*',
            'master_letter.let_name',
            'draft.work_name as drafter_name',
            'org.sator_name',
            'suborg.sub_sator_name',
            'sign.work_name as sign_name',
            'master_unit_letter.unit_name',
            'master_classification.classification_name'
        )
            ->leftjoin('master_letter', 'master_letter.id', 'outgoing_mails.id_mst_letter')
            ->leftjoin('master_workunit as draft', 'draft.id', 'outgoing_mails.drafter')
            ->leftjoin('master_sator as org', 'org.id', 'outgoing_mails.org_unit')
            ->leftjoin('master_sub_sator as suborg', 'suborg.id', 'outgoing_mails.sub_org_unit')
            ->leftjoin('master_workunit as sign', 'sign.id', 'outgoing_mails.signing')
            ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'outgoing_mails.mail_unit')
            ->leftjoin('master_classification', 'master_classification.id', 'outgoing_mails.archive_classification')
            ->where('outgoing_mails.id', $id)
            ->first();

        $kka_type = null;
        if ($data->kka_type != null) {
            $kka_type = KkaType::where('id', $data->kka_type)->first();
        }
        $kka_codes = null;
        if ($data->kka_code != null) {
            $kka_codes = KkaCode::where('kka_code', $data->kka_code)->first();
        }

        return view('mail.outgoing.info', compact('data', 'kka_type', 'kka_codes'));
    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);

        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();
        $archive_remains = Dropdown::where('category', 'Arsip Pertinggal')->get();

        $letters = Letter::where('is_active', 1)->get();
        $workunits = WorkUnit::where('is_active', 1)->get();
        $unitletters = UnitLetter::where('is_active', 1)->get();
        $classifications = Classification::where('is_active', 1)->get();
        $sators = Sator::orderBy('sator_name', 'asc')->where('is_active', 1)->get();
        $gedungs = DaftarGedung::where('is_active', 1)->get();

        $dataEdit = OutgoingMail::where('id', $id)->first();
        // Fetch the corresponding additional data
        $lettersData = Letter::where('id', $dataEdit->id_mst_letter)->first();
        $workunitsData = WorkUnit::where('id', $dataEdit->signing)->first();
        $unitlettersData = UnitLetter::where('id', $dataEdit->mail_unit)->first();
        $satorsData = Sator::where('id', $dataEdit->org_unit)->first();
        // Merge the original collections with the additional data if not null, and remove duplicates based on 'id'
        $letters = $lettersData ? $letters->merge([$lettersData])->unique('id') : $letters;
        $workunits = $workunitsData ? $workunits->merge([$workunitsData])->unique('id') : $workunits;
        $unitletters = $unitlettersData ? $unitletters->merge([$unitlettersData])->unique('id') : $unitletters;
        $sators = $satorsData ? $sators->merge([$satorsData])->unique('id') : $sators;

        // Check Letter Has KKA
        $kkaTypes = [];
        $kkaCodes = [];
        if ($dataEdit->kka_type != null) {
            $kkaTypes = KkaType::where('is_active', 1)->get();
            $kkaTypeData = KkaType::where('id', $dataEdit->kka_type)->first();
            $kkaTypes = $kkaTypeData ? $kkaTypes->merge([$kkaTypeData])->unique('id') : $kkaTypes;

            $kkaCodes = KkaCode::where('id_kka_type', $dataEdit->kka_type)->get();
        }

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

        $path = json_decode($data->location_save_route);
        if ($data->location_save != null) {
            $idGedung = $path->idGedung;
            $idLantai = $path->idLantai;
            $idRuang = $path->idRuang;
            $idRak = $path->idRak;
            $idBaris = $path->idBaris;
            $idKolom = $path->idKolom;
            $idBoks = $path->idBoks;
        } else {
            $idGedung = null;
            $idLantai = null;
            $idRuang = null;
            $idRak = null;
            $idBaris = null;
            $idKolom = null;
            $idBoks = null;
        }
        $listLantai = DaftarLantai::where('id_gedung', $idGedung)->get();
        $listRuang = DaftarRuang::where('id_lantai', $idLantai)->get();
        $listRak = DaftarRak::where('id_ruang', $idRuang)->get();
        $listBaris = DaftarBaris::where('id_rak', $idRak)->get();
        $listKolom = DaftarKolom::where('id_baris', $idBaris)->get();
        $listBoks = DaftarBox::where('id_kolom', $idKolom)->get();

        return view('mail.outgoing.edit', compact(
            'letters',
            'workunits',
            'sators',
            'unitletters',
            'classifications',
            'receivedvias',
            'sators',
            'archive_remains',
            'data',
            'gedungs',
            'path',
            'listLantai',
            'listRuang',
            'listRak',
            'listBaris',
            'listKolom',
            'listBoks',
            'kkaTypes',
            'kkaCodes'
        ));
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        // dd($request->all());

        $request->validate([
            "id_mst_letter" => "required",
            "mail_regarding" => "required",
            "out_date" => "required",
            "signing" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
            "archive_remain" => "required",
        ], [
            'id_mst_letter.required' => 'Jenis Naskah Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'out_date.required' => 'Tanggal Keluar Wajib Untuk Diisi.',
            'signing.required' => 'Penandatanganan Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
            'archive_remain.required' => 'Arsip Pertinggal Wajib Untuk Diisi.',
        ]);

        $out_date = (new DateTime($request->out_date))->format('Y-m-d H:i:s');
        $mail_date = (new DateTime($request->mail_date))->format('Y-m-d H:i:s');
        // $mail_retention_from = (new DateTime($request->mail_retention_from))->format('Y-m-d H:i:s');
        // $mail_retention_to = (new DateTime($request->mail_retention_to))->format('Y-m-d H:i:s');
        // $location_save_route = [
        //     'idGedung' => $request->input('namaGedung'),
        //     'idLantai' => $request->input('namaLantai'),
        //     'idRuang' => $request->input('namaRuang'),
        //     'idRak' => $request->input('namaRak'),
        //     'idBaris' => $request->input('namaBaris'),
        //     'idKolom' => $request->input('namaKolom'),
        //     'idBoks' => $request->input('namaBoks'),
        // ];
        // $location_save_route = json_encode($location_save_route);    

        // Check With Data Before
        $databefore = OutgoingMail::where('id', $id)->first();

        $kkaCodeUpdated = ($databefore->kka_code != $request->kka_code);

        $databefore->id_mst_letter = $request->id_mst_letter;
        $databefore->kka_type = $request->kka_type;
        $databefore->kka_code = $request->kka_code;
        $databefore->org_unit = $request->org_unit;
        $databefore->sub_org_unit = $request->sub_org_unit;
        $databefore->mail_regarding = $request->mail_regarding;
        $databefore->out_date = $out_date;
        $databefore->mail_date = $mail_date;
        $databefore->signing = $request->signing;
        $databefore->signing_other = $request->signing_other;
        $databefore->receiver = $request->receiver;
        $databefore->mail_quantity = $request->mail_quantity;
        $databefore->mail_unit = $request->mail_unit;
        $databefore->archive_remains = $request->archive_remain;
        $databefore->attachment_text = $request->attachment_text;
        $databefore->information = $request->information;

        // $databefore->drafter = $request->drafter;
        // $databefore->archive_classification = $request->archive_classification;
        // $databefore->mail_retention_from = $mail_retention_from;
        // $databefore->mail_retention_to = $mail_retention_to;
        // $databefore->location_save = $request->save_location;
        // if($databefore->location_save != $request->save_location){
        //     $databefore->location_save_route = $location_save_route;
        //     $newroute = $location_save_route;
        // } else {
        //     $newroute = $databefore->location_save_route;
        // }
        // $databefore->received_via = $request->received_via;
        // $databefore->ref_number = $request->ref_number;
        // $databefore->ref_mail = $request->mail_ref;

        // if($request->attachment_text != null){
        //     $jmlHal = $request->mail_quantity + $request->attachment_text;
        // } else {
        //     $jmlHal = $request->mail_quantity;
        // }

        if ($databefore->isDirty()) {
            DB::beginTransaction();
            try {
                if ($kkaCodeUpdated) {
                    $mailNumber = str_replace($request->kka_code_before, $request->kka_code, $databefore->mail_number);
                } else {
                    $mailNumber = $databefore->mail_number;
                }

                // Update Outgoing Mail
                OutgoingMail::where('id', $id)->update([
                    'id_mst_letter' => $request->id_mst_letter,

                    'mail_number' => $mailNumber,
                    'kka_type' => $request->kka_type,
                    'kka_code' => $request->kka_code,

                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'mail_regarding' => $request->mail_regarding,
                    'out_date' => $request->out_date,
                    'mail_date' => $request->mail_date,
                    'signing' => $request->signing,
                    'signing_other' => $request->signing_other,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    'archive_remains' => $request->archive_remain,
                    'attachment_text' => $request->attachment_text,
                    'information' => $request->information,
                    'status' => null,
                    'updated_by' => auth()->user()->name,

                    // 'drafter' => $request->drafter,
                    // 'archive_classification' => $request->archive_classification,
                    // 'mail_retention_from' => $request->mail_retention_from,
                    // 'mail_retention_to' => $request->mail_retention_to,
                    // 'location_save' => $request->save_location,
                    // 'location_save_route' => $location_save_route,
                    // 'received_via' => $request->received_via,
                    // 'ref_number' => $request->ref_number,
                    // 'ref_mail' => $request->mail_ref,
                    // 'jml_hal' => $jmlHal,
                ]);

                DB::commit();
                return redirect()->route('outgoingmail.index')->with(['success' => 'Sukses Ubah Data']);
            } catch (Throwable $th) {
                DB::rollback();
                return redirect()->back()->with(['fail' => 'Gagal Ubah Data!']);
            }
        } else {
            return redirect()->route('outgoingmail.index')->with(['info' => 'Tidak ada perubahan, data sama dengan yang sebelumnya']);
        }
    }

    public function generateNumbering($pattern, $number)
    {
        // Current date for date replacements
        $currentDate = Carbon::now();

        // Replace the autonumber format (@)
        if (preg_match('/@{\d+}/', $pattern, $matches)) {
            $autonumberFormat = $matches[0];
            $digits = (int) filter_var($autonumberFormat, FILTER_SANITIZE_NUMBER_INT);
            $formattedNumber = str_pad($number, $digits, '0', STR_PAD_LEFT);
            $pattern = str_replace($autonumberFormat, $formattedNumber, $pattern);
        }

        // Replace date placeholders (#MM, #DD, #YYYY)
        if (strpos($pattern, '#^MM') !== false) {
            $romanMonth = $this->toRoman((int) $currentDate->format('m'));
            $pattern = str_replace('#^MM', $romanMonth, $pattern);
        } else {
            $pattern = str_replace('#MM', $currentDate->format('m'), $pattern);
        }
        if (strpos($pattern, '#^DD') !== false) {
            $romanDay = $this->toRoman((int) $currentDate->format('d'));
            $pattern = str_replace('#^DD', $romanDay, $pattern);
        } else {
            $pattern = str_replace('#MM', $currentDate->format('d'), $pattern);
        }
        if (strpos($pattern, '#^YYYY') !== false) {
            $romanYear = $this->toRoman((int) $currentDate->format('Y'));
            $pattern = str_replace('#^YYYY', $romanYear, $pattern);
        } else {
            $pattern = str_replace('#YYYY', $currentDate->format('Y'), $pattern);
        }

        // Replace Roman numeral format (^)
        if (preg_match('/@\{\^\d+\}/', $pattern, $matches)) {
            $romanNumeralFormat = $matches[0];
            $digits = (int) filter_var($romanNumeralFormat, FILTER_SANITIZE_NUMBER_INT);
            $formattedNumber = $this->toRoman($number);
            $pattern = str_replace($romanNumeralFormat, $formattedNumber, $pattern);
        }

        // Remove single quotes
        $pattern = str_replace("'", '', $pattern);

        return $pattern;
    }

    public function generateNumberingWithout($pattern, $number)
    {
        // Current date for date replacements
        $currentDate = Carbon::now();

        // Replace the autonumber format (@)
        if (preg_match('/@{\d+}/', $pattern, $matches)) {
            $autonumberFormat = $matches[0];
            $pattern = str_replace($autonumberFormat, $number, $pattern);
        }

        // Replace date placeholders (#MM, #DD, #YYYY)
        if (strpos($pattern, '#^MM') !== false) {
            $romanMonth = $this->toRoman((int) $currentDate->format('m'));
            $pattern = str_replace('#^MM', $romanMonth, $pattern);
        } else {
            $pattern = str_replace('#MM', $currentDate->format('m'), $pattern);
        }
        if (strpos($pattern, '#^DD') !== false) {
            $romanDay = $this->toRoman((int) $currentDate->format('d'));
            $pattern = str_replace('#^DD', $romanDay, $pattern);
        } else {
            $pattern = str_replace('#MM', $currentDate->format('d'), $pattern);
        }
        if (strpos($pattern, '#^YYYY') !== false) {
            $romanYear = $this->toRoman((int) $currentDate->format('Y'));
            $pattern = str_replace('#^YYYY', $romanYear, $pattern);
        } else {
            $pattern = str_replace('#YYYY', $currentDate->format('Y'), $pattern);
        }

        // Replace Roman numeral format (^)
        if (preg_match('/@\{\^\d+\}/', $pattern, $matches)) {
            $romanNumeralFormat = $matches[0];
            $digits = (int) filter_var($romanNumeralFormat, FILTER_SANITIZE_NUMBER_INT);
            $formattedNumber = $this->toRoman($number);
            $pattern = str_replace($romanNumeralFormat, $formattedNumber, $pattern);
        }

        // Remove single quotes
        $pattern = str_replace("'", '', $pattern);

        return $pattern;
    }

    private function toRoman($number)
    {
        $map = [
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4,
            'I' => 1
        ];
        $result = '';
        foreach ($map as $roman => $int) {
            while ($number >= $int) {
                $result .= $roman;
                $number -= $int;
            }
        }
        return $result;
    }

    public function generatenumber()
    {
        $que = QueNumbOutMail::select('que_numb_outgoing_mail.*', 'outgoing_mails.org_unit', 'outgoing_mails.mail_date', 'master_pattern.pat_simple', 'master_pattern.pat_mix', 'master_pattern.pat_type')
            ->leftjoin('outgoing_mails', 'que_numb_outgoing_mail.id_mail', 'outgoing_mails.id')
            ->leftjoin('master_pattern', 'que_numb_outgoing_mail.id_mst_letter', 'master_pattern.let_id')
            ->get();

        if ($que->isEmpty()) {
            return redirect()->back()->with(['info' => 'Tidak Ada Aksi, Semua Nomor Email Telah Digenerate']);
        }

        DB::beginTransaction();
        try {
            $error = false;
            foreach ($que as $q) {
                if ($q->pat_type == "Sederhana") {
                    $lastnumber = LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->first();
                    $number = $lastnumber ? $lastnumber->last_number : 0;
                    $pattern = $q->pat_simple;
                    $number++;
                    $mail_number_with = $this->generateNumbering($pattern, $number);
                    $mail_number = $this->generateNumberingWithout($pattern, $number);

                    //Update Mail Number
                    OutgoingMail::where('id', $q->id_mail)->update(["mail_number" => $mail_number, "mail_number_with" => $mail_number_with]);
                    //Update Last Number
                    $lastnumber = LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->first();
                    if ($lastnumber) {
                        LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->update(["last_number" => $number]);
                    } else {
                        LastNumberingOutgoing::create([
                            'id_mst_letter' => $q->id_mst_letter,
                            'last_number' => $number,
                        ]);
                    }
                    //Delete Que
                    QueNumbOutMail::where('id_mail', $q->id_mail)->delete();
                } elseif ($q->pat_type == "Perpaduan") {
                    $lastnumber = LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->first();
                    $number = $lastnumber ? $lastnumber->last_number : 0;
                    $number++;

                    $pattern = $q->pat_mix;
                    $patterns = json_decode($pattern, true);

                    $mail_number = [];

                    foreach ($patterns as $pat) {
                        if ($pat == "Naskah Dinas") {
                            $value = strtoupper(Letter::where('id', $q->id_mst_letter)->first()->let_code);
                            $mail_number[] = $value;
                        } elseif ($pat == "Unit Kerja") {
                            $value = strtoupper(Sator::where('id', $q->org_unit)->first()->sator_name);
                            $mail_number[] = $value;
                        } elseif ($pat == "Sifat Surat") {
                            $value = "Null";
                            $mail_number[] = $value;
                        } elseif ($pat == "Nomor Urut") {
                            $value = $number;
                            $mail_number[] = $value;
                            // Update Last Number
                            $lastnumber = LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->first();
                            if ($lastnumber) {
                                LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->update(["last_number" => $number]);
                            } else {
                                LastNumberingOutgoing::create([
                                    'id_mst_letter' => $q->id_mst_letter,
                                    'last_number' => $number,
                                ]);
                            }
                        } elseif ($pat == "Bulan Terbit") {
                            $timestamp = strtotime($q->mail_date);
                            $value = date('m', $timestamp);
                            $mail_number[] = $value;
                        } elseif ($pat == "Tahun Terbit") {
                            $timestamp = strtotime($q->mail_date);
                            $value = date('Y', $timestamp);
                            $mail_number[] = $value;
                        } else {
                            $value = "Null";
                            $mail_number[] = $value;
                        }
                    }
                    $mail_number = implode('/', $mail_number);

                    //Update Mail Number
                    OutgoingMail::where('id', $q->id_mail)->update(["mail_number" => $mail_number]);
                    //Delete Que
                    QueNumbOutMail::where('id_mail', $q->id_mail)->delete();
                } elseif ($q->pat_type == "Tidak Ada Nomor") {
                    $mail_number = "Tidak Ada Nomor";

                    //Update Mail Number
                    OutgoingMail::where('id', $q->id_mail)->update(["mail_number" => $mail_number]);
                    //Delete Que
                    QueNumbOutMail::where('id_mail', $q->id_mail)->delete();
                } else {
                    $error = true;
                    //Update Que
                    QueNumbOutMail::where('id_mail', $q->id_mail)->update(["status" => 1]);
                }
            }

            DB::commit();
            if ($error) {
                return redirect()->route('outgoingmail.index')->with(['success' => 'Sukses Generate Nomor Email, Namun Ada Nomor Yang Gagal Tergenerate']);
            } else {
                return redirect()->route('outgoingmail.index')->with(['success' => 'Sukses Generate Nomor Email']);
            }
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Generate Nomor Email!']);
        }
    }

    public function checkpattern($id)
    {
        $pattern = Pattern::where('let_id', $id)->first();
        if ($pattern == null) {
            $pat_mix = null;
        } else {
            $pat_mix = $pattern->pat_mix;
        }
        if ($pat_mix == null) {
            $rule = "NR";
        } else {
            if (strpos($pat_mix, "Unit Kerja") !== false) {
                $rule = "R";
            } else {
                $rule = "NR";
            }
        }
        return response()->json($rule);
    }
}
