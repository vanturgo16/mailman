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
use App\Models\QueNumbIncMail;
use App\Models\Sator;
use App\Models\UnitLetter;
use App\Models\WorkUnit;
use App\Models\Classification;
use App\Models\Complain;
use App\Models\Dropdown;
use App\Models\ProgressIncommingMail;

class IncommingMailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(['permission:surat_masuk']);
    } 
    
    public function index(Request $request)
    {
        // Initiate Variable Filter
        $entry_date = $request->get('entry_date');
        $mail_date = $request->get('mail_date');
        $mail_number = $request->get('mail_number');
        $placeman = $request->get('placeman');
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::get();
        $org_unit = $request->get('org_unit');

        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $complains = Complain::get();
        $letters = Letter::get();
        $sators = Sator::orderBy('sator_name','asc')->get();

        $datas = IncommingMail::select('incomming_mails.*', 'incomming_mails.updated_at as last_update', 'incomming_mails.created_at as created', 'master_unit_letter.unit_name', 'master_sub_sator.sub_sator_name')
            ->leftjoin('master_sub_sator', 'incomming_mails.sub_org_unit', 'master_sub_sator.id')
            ->leftjoin('master_unit_letter', 'incomming_mails.mail_unit', 'master_unit_letter.id')
            ->where('placeman', '!=', 'LITNADIN')
            ->orderBy('created_at', 'desc');

        // FIlter
        if ($entry_date != null) {
            $datas->where('incomming_mails.entry_date', 'like', '%' . $entry_date . '%');
        }
        if ($mail_date != null) {
            $datas->where('incomming_mails.mail_date', 'like', '%' . $mail_date . '%');
        }
        if ($mail_number != null) {
            $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%');
        }
        if ($placeman != null) {
            $datas->where('placeman', $placeman);
        }
        if ($org_unit != null) {
            $datas->where('org_unit', $org_unit);
        }
    
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

        return view('mail.incomming.index', compact('workunits', 'placemans', 'complains', 'letters',
            'entry_date', 'mail_date', 'mail_number', 'placeman', 'receiverMails', 'org_unit', 'sators'));
    }
    
    public function directupdate(Request $request, $id)
    {
        $id = $id;

        if($request[1] != null){
            $date = new DateTime($request[1]);
            $dateVal = $date->format('Y-m-d H:i:s');
        } else {
            $dateVal = null;
        }

        // Check With Data Before
        $databefore = IncommingMail::where('id', $id)->first();
        $databefore->mail_date = $dateVal;
        // $databefore->agenda_number = $request[2];
        $databefore->mail_number = $request[3];
        // $databefore->sender = $request[4];
        $databefore->mail_regarding = $request[5];
        $databefore->receiver = $request[6];
        $databefore->mail_quantity = $request[7];
        $databefore->attachment_text = $request[8];
        $databefore->information = $request[9];

        if($databefore->isDirty()){
            DB::beginTransaction();
            try {
                
                // Update Incomming Mail
                IncommingMail::where('id', $id)->update([
                    'mail_date' => $request[1],
                    // 'agenda_number' => $request[2],
                    'mail_number' => $request[3],
                    // 'sender' => $request[4],
                    'mail_regarding' => $request[5],
                    'receiver' => $request[6],
                    'mail_quantity' => $request[7],
                    'attachment_text' => $request[8],
                    'information' => $request[9],
                    'updated_by' => auth()->user()->name,
                ]);
    
                DB::commit();
                return response()->json(['success' => true]);
            } catch (Throwable $th) {
                DB::rollback();
                return response()->json(['success' => false]);
            }
        }
        else {
            return response()->json(['success' => "Same"]);
        }
    }

    public function rekapitulasi(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $mail_number = $request->get('mail_number');
        $placeman = $request->get('placeman');
        $complain = $request->get('complain');
        $letter = $request->get('letter');

        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $complains = Complain::get();
        $letters = Letter::get();
        
        if (isset($startdate) || isset($enddate) || isset($mail_number) || isset($placeman) || isset($letter)) 
        {
            $datas = IncommingMail::select('incomming_mails.*', 'incomming_mails.updated_at as last_update', 'master_unit_letter.unit_name', 'master_sub_sator.sub_sator_name')
            ->leftjoin('master_sub_sator', 'incomming_mails.sub_org_unit', 'master_sub_sator.id')
            ->leftjoin('master_unit_letter', 'incomming_mails.mail_unit', 'master_unit_letter.id')
            ->orderBy('created_at', 'desc');
            
            // Filter
            if ($startdate != null) {
                $startdatesearch = (new DateTime($startdate))->format('Y-m-d H:i:s');
                $datas->where(function ($query) use ($startdatesearch) {
                    $query->where('incomming_mails.mail_date', '>=', $startdatesearch)
                        ->orWhere('incomming_mails.entry_date', '>=', $startdatesearch);
                });
            }
            if ($enddate != null) {
                $enddatesearch = (new DateTime($enddate))->format('Y-m-d H:i:s');
                $datas->where(function ($query) use ($enddatesearch) {
                    $query->where('incomming_mails.mail_date', '<=', $enddatesearch)
                        ->orWhere('incomming_mails.entry_date', '<=', $enddatesearch);
                });
            }
            if ($mail_number != null) {
                // $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%');

                $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.agenda_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.mail_regarding', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.information', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.sub_sator_name', 'like', '%' . $mail_number . '%');
            }
            if ($placeman != null) {
                $datas->where('incomming_mails.placeman', $placeman);
            }
            if ($letter != null) {
                $datas->where('incomming_mails.id_mst_letter', $letter);
            }
        
            // Get Query
            $datas = $datas->get();

        } else {
            $datas = [];
        }

        if ($request->ajax()) {
            $data = DataTables::of($datas)->toJson();
            return $data;
        }

        return view('mail.incomming.rekapitulasi', compact('placemans', 'complains', 'letters',
            'datas', 'startdate', 'enddate', 'mail_number', 'placeman', 'complain', 'letter'));
    }

    public function rekapitulasiPrint(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $mail_number = $request->get('mail_number');
        $placeman = $request->get('placeman');
        $complain = $request->get('complain');
        $letter = $request->get('letter');
        
        if (isset($startdate) || isset($enddate) || isset($mail_number) || isset($placeman) || isset($letter)) 
        {
            $datas = IncommingMail::select('incomming_mails.*', 'incomming_mails.updated_at as last_update', 'master_unit_letter.unit_name', 'master_sub_sator.sub_sator_name')
            ->leftjoin('master_sub_sator', 'incomming_mails.sub_org_unit', 'master_sub_sator.id')
            ->leftjoin('master_unit_letter', 'incomming_mails.mail_unit', 'master_unit_letter.id')
            ->orderBy('created_at', 'desc');

            // Filter
            if ($startdate != null) {
                $startdatesearch = (new DateTime($startdate))->format('Y-m-d H:i:s');
                $datas->where(function ($query) use ($startdatesearch) {
                    $query->where('incomming_mails.mail_date', '>=', $startdatesearch)
                        ->orWhere('incomming_mails.entry_date', '>=', $startdatesearch);
                });
            }
            if ($enddate != null) {
                $enddatesearch = (new DateTime($enddate))->format('Y-m-d H:i:s');
                $datas->where(function ($query) use ($enddatesearch) {
                    $query->where('incomming_mails.mail_date', '<=', $enddatesearch)
                        ->orWhere('incomming_mails.entry_date', '<=', $enddatesearch);
                });
            }
            if ($mail_number != null) {
                // $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%');

                $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.agenda_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.mail_regarding', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.information', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.sub_sator_name', 'like', '%' . $mail_number . '%');
            }
            if ($placeman != null) {
                $datas->where('incomming_mails.placeman', $placeman);
            }
            if ($letter != null) {
                $datas->where('incomming_mails.id_mst_letter', $letter);
            }
        
            // Get Query
            $datas = $datas->get();

        } else {
            $datas = [];
        }

        $now=Carbon::now()->format('YmdHis');
        
        $pdf = PDF::loadView('pdf.rekapitulasi-suratmasuk', [
            'startdate' => $startdate,
            'enddate' => $enddate,
            'print_date' => $now,
            'user' => auth()->user()->name,
            'datas' => $datas,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Print Rekapitulasi Surat Masuk.pdf', array("Attachment" => false));

    }

    public function create(Request $request)
    {
        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $complains = Complain::get();
        $letters = Letter::get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::get();
        // Surat Masuk Kategori 1 & 3
        $unitletters = UnitLetter::whereIn('category', ['1', '3'])->get();
        $classifications = Classification::get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();
        $mailtypes = Dropdown::where('category', 'Jenis Surat')->get();
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();

        $sators = Sator::orderBy('sator_name','asc')->get();

        return view('mail.incomming.create', compact('placemans', 'complains', 'letters',
            'workunits', 'receiverMails', 'unitletters', 'classifications', 'results',
            'approveds', 'mailtypes', 'receivedvias', 'sators'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "placeman" => "required",
            "mail_regarding" => "required",
            "entry_date" => "required",
            "receiver" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
            "id_mst_complain" => "required_if:placeman,PENGADUAN",
            "id_mst_letter" => "required_unless:placeman,PENGADUAN",
        ], 
        [
            'placeman.required' => 'Pejabat / Naskah Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'entry_date.required' => 'Tanggal Masuk Wajib Untuk Diisi.',
            'receiver.required' => 'Penerima Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
            'id_mst_complain.required' => 'Jenis Pengaduan Wajib Untuk Diisi.',
            'id_mst_letter.required' => 'Jenis Naskah Wajib Untuk Diisi.',
        ]);

        DB::beginTransaction();
        try {
            // Store Outgoing Mail
            if($request->placeman == "LITNADIN"){
                // $sender = $request->senderSelect;
                $mail_type = null;
                $result = $request->result;
                $approved_by = $request->approved_by;
                $received_via = $request->received_viaInput;
            } else {
                // $sender = $request->senderInput;
                $mail_type = $request->mail_type;
                $result = null;
                $approved_by = null;
                $received_via = $request->received_viaSelect;
            }
            
            $store = IncommingMail::create([
                'placeman' => $request->placeman,
                'id_mst_letter' => $request->id_mst_letter,
                'id_mst_complain' => $request->id_mst_complain,
                'org_unit' => $request->org_unit,
                'sub_org_unit' => $request->sub_org_unit,
                // 'sender' => $sender,
                'mail_number' => $request->mail_number,
                'mail_regarding' => $request->mail_regarding,
                'entry_date' => $request->entry_date,
                'mail_date' => $request->mail_date,
                'receiver' => $request->receiver,
                'mail_quantity' => $request->mail_quantity,
                'mail_unit' => $request->mail_unit,
                // 'archive_classification' => $request->archive_classification,
                // 'mail_retention_from' => $request->mail_retention_from,
                // 'mail_retention_to' => $request->mail_retention_to,
                'mail_type' => $mail_type,
                'result' => $result,
                'approved_by' => $approved_by,
                'received_via' => $received_via,
                'attachment_text' => $request->attachment_text,
                'information' => $request->information,
                'jml_hal' => null,
                'status' => null,
                'created_by' => auth()->user()->name,
            ]);

            // Register Que
            if($request->placeman == "PENGADUAN"){
                $id_mst_letter = 0;
            } else {
                $id_mst_letter = $request->id_mst_letter;
            }
            QueNumbIncMail::create([
                'id_mail' => $store->id,
                'id_mst_letter' => $id_mst_letter
            ]);

            DB::commit();
            return redirect()->route('incommingmail.index')->with(['success' => 'Sukses Tambah Data']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data!']);
        }
    }

    public function createbulk(Request $request)
    {
        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $complains = Complain::get();
        $letters = Letter::get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::get();
        // Surat Masuk Kategori 1 & 3
        $unitletters = UnitLetter::whereIn('category', ['1', '3'])->get();
        $classifications = Classification::get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();
        $mailtypes = Dropdown::where('category', 'Jenis Surat')->get();
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();

        $sators = Sator::orderBy('sator_name','asc')->get();

        return view('mail.incomming.createbulk', compact('placemans', 'complains', 'letters',
            'workunits', 'receiverMails', 'unitletters', 'classifications', 'results',
            'approveds', 'mailtypes', 'receivedvias', 'sators'));
    }

    public function storebulk(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "placeman" => "required",
            "mail_regarding" => "required",
            "entry_date" => "required",
            "receiver" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
            "id_mst_complain" => "required_if:placeman,PENGADUAN",
            "id_mst_letter" => "required_unless:placeman,PENGADUAN",
        ], 
        [
            'placeman.required' => 'Pejabat / Naskah Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'entry_date.required' => 'Tanggal Masuk Wajib Untuk Diisi.',
            'receiver.required' => 'Penerima Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
            'id_mst_complain.required' => 'Jenis Pengaduan Wajib Untuk Diisi.',
            'id_mst_letter.required' => 'Jenis Naskah Wajib Untuk Diisi.',
        ]);

        $amountLetter = $request->amount_letter;
        
        DB::beginTransaction();
        try {
            if($request->placeman == "LITNADIN"){
                // $sender = $request->senderSelect;
                $mail_type = null;
                $result = $request->result;
                $approved_by = $request->approved_by;
                $received_via = $request->received_viaInput;
            } else {
                // $sender = $request->senderInput;
                $mail_type = $request->mail_type;
                $result = null;
                $approved_by = null;
                $received_via = $request->received_viaSelect;
            }

            for ($i = 0; $i < $amountLetter; $i++) {
                
                $store = IncommingMail::create([
                    'placeman' => $request->placeman,
                    'id_mst_letter' => $request->id_mst_letter,
                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'id_mst_complain' => $request->id_mst_complain,
                    // 'sender' => $sender,
                    'mail_number' => $request->mail_number,
                    'mail_regarding' => $request->mail_regarding,
                    'entry_date' => $request->entry_date,
                    'mail_date' => $request->mail_date,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    // 'archive_classification' => $request->archive_classification,
                    // 'mail_retention_from' => $request->mail_retention_from,
                    // 'mail_retention_to' => $request->mail_retention_to,
                    'mail_type' => $mail_type,
                    'result' => $result,
                    'approved_by' => $approved_by,
                    'received_via' => $received_via,
                    'attachment_text' => $request->attachment_text,
                    'information' => $request->information,
                    'jml_hal' => null,
                    'status' => null,
                    'created_by' => auth()->user()->name,
                ]);

                // Register Que
                if($request->placeman == "PENGADUAN"){
                    $id_mst_letter = 0;
                } else {
                    $id_mst_letter = $request->id_mst_letter;
                }
                QueNumbIncMail::create([
                    'id_mail' => $store->id,
                    'id_mst_letter' => $id_mst_letter
                ]);
            }

            DB::commit();
            return redirect()->route('incommingmail.index')->with(['success' => 'Sukses Tambah Data (Bulk) Dengan Jumlah : '.$amountLetter.'']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data (Bulk)!']);
        }
    }
    
    public function detail($id)
    {
        $id = decrypt($id);
        // dd($id);

        $data = IncommingMail::select('incomming_mails.*', 'master_letter.let_name', 'master_complain.com_name', 'receiv.work_name as receiver_name',
            'master_unit_letter.unit_name', 'master_classification.classification_name', 'org.sator_name', 'suborg.sub_sator_name'
        )
            ->leftjoin('master_letter', 'master_letter.id', 'incomming_mails.id_mst_letter')
            ->leftjoin('master_complain', 'master_complain.id', 'incomming_mails.id_mst_complain')
            ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'incomming_mails.mail_unit')
            ->leftjoin('master_sator as org', 'org.id', 'incomming_mails.org_unit')
            ->leftjoin('master_sub_sator as suborg', 'suborg.id', 'incomming_mails.sub_org_unit')
            ->leftjoin('master_workunit as receiv', 'receiv.id', 'incomming_mails.receiver')
            ->leftjoin('master_classification', 'master_classification.id', 'incomming_mails.archive_classification')
            ->where('incomming_mails.id', $id)
            ->first();

        return view('mail.incomming.info', compact('data'));
    }
    
    public function edit(Request $request, $id)
    {
        $id = decrypt($id);

        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $complains = Complain::get();
        $letters = Letter::get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::get();
        // Surat Masuk Kategori 1 & 3
        $unitletters = UnitLetter::whereIn('category', ['1', '3'])->get();
        $classifications = Classification::get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();
        $mailtypes = Dropdown::where('category', 'Jenis Surat')->get();
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();
        $sators = Sator::orderBy('sator_name','asc')->get();

        $data = IncommingMail::select('incomming_mails.*', 'master_letter.let_name', 'master_complain.com_name', 'receiv.work_name as receiver_name',
            'master_unit_letter.unit_name', 'master_classification.classification_name'
        )
            ->leftjoin('master_letter', 'master_letter.id', 'incomming_mails.id_mst_letter')
            ->leftjoin('master_complain', 'master_complain.id', 'incomming_mails.id_mst_complain')
            ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'incomming_mails.mail_unit')
            ->leftjoin('master_workunit as receiv', 'receiv.id', 'incomming_mails.receiver')
            ->leftjoin('master_classification', 'master_classification.id', 'incomming_mails.archive_classification')
            ->where('incomming_mails.id', $id)
            ->first();

        return view('mail.incomming.edit', compact('placemans', 'complains', 'letters',
            'receiverMails', 'workunits', 'unitletters', 'classifications',
            'results', 'approveds', 'mailtypes', 'receivedvias', 'sators', 'data'));
    }
    
    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        //dd($id);

        $request->validate([
            "placeman" => "required",
            "mail_regarding" => "required",
            "entry_date" => "required",
            "receiver" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
            "id_mst_complain" => "required_if:placeman,PENGADUAN",
            "id_mst_letter" => "required_unless:placeman,PENGADUAN",
        ], 
        [
            'placeman.required' => 'Pejabat / Naskah Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'entry_date.required' => 'Tanggal Masuk Wajib Untuk Diisi.',
            'receiver.required' => 'Penerima Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
            'id_mst_complain.required' => 'Jenis Pengaduan Wajib Untuk Diisi.',
            'id_mst_letter.required' => 'Jenis Naskah Wajib Untuk Diisi.',
        ]);

        $entry_date = (new DateTime($request->entry_date))->format('Y-m-d H:i:s');
        if($request->mail_date != null)
            $mail_date = (new DateTime($request->mail_date))->format('Y-m-d H:i:s');
        else {
            $mail_date = null;
        }
        // $mail_retention_from = (new DateTime($request->mail_retention_from))->format('Y-m-d H:i:s');
        // $mail_retention_to = (new DateTime($request->mail_retention_to))->format('Y-m-d H:i:s');

        if($request->placeman == "LITNADIN"){
            // $sender = $request->senderSelect;
            $mail_type = null;
            $result = $request->result;
            $approved_by = $request->approved_by;
            $received_via = $request->received_viaInput;
        } else {
            // $sender = $request->senderInput;
            $mail_type = $request->mail_type;
            $result = null;
            $approved_by = null;
            $received_via = $request->received_viaSelect;
        }

        // Check With Data Before
        $databefore = IncommingMail::where('id', $id)->first();

        if($databefore->placeman == 'LITNADIN') {
            $databefore->result = $result;
            $databefore->approved_by = $approved_by;
        } elseif($databefore->placeman == 'PENGADUAN') {
            $databefore->id_mst_complain = $request->id_mst_complain;
            $databefore->mail_type = $mail_type;
        } else {
            $databefore->id_mst_letter = $request->id_mst_letter;
            $databefore->mail_type = $mail_type;
        }

        $databefore->placeman = $request->placeman;
        // $databefore->sender = $sender;
        $databefore->org_unit = $request->org_unit;
        $databefore->sub_org_unit = $request->sub_org_unit;
        $databefore->mail_number = $request->mail_number;
        $databefore->mail_regarding = $request->mail_regarding;
        $databefore->entry_date = $entry_date;
        $databefore->mail_date = $mail_date;
        $databefore->receiver = $request->receiver;
        $databefore->mail_quantity = $request->mail_quantity;
        $databefore->mail_unit = $request->mail_unit;
        // $databefore->archive_classification = $request->archive_classification;
        // $databefore->mail_retention_from = $mail_retention_from;
        // $databefore->mail_retention_to = $mail_retention_to;
        $databefore->received_via = $received_via;
        $databefore->attachment_text = $request->attachment_text;
        $databefore->information = $request->information;

        if($databefore->isDirty()){
            DB::beginTransaction();
            try {
                IncommingMail::where('id', $id)->update([
                    'placeman' => $request->placeman,
                    'id_mst_letter' => $request->id_mst_letter,
                    'id_mst_complain' => $request->id_mst_complain,
                    // 'sender' => $sender,
                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'mail_number' => $request->mail_number,
                    'mail_regarding' => $request->mail_regarding,
                    'entry_date' => $request->entry_date,
                    'mail_date' => $request->mail_date,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    // 'archive_classification' => $request->archive_classification,
                    // 'mail_retention_from' => $request->mail_retention_from,
                    // 'mail_retention_to' => $request->mail_retention_to,
                    'mail_type' => $mail_type,
                    'result' => $result,
                    'approved_by' => $approved_by,
                    'received_via' => $received_via,
                    'attachment_text' => $request->attachment_text,
                    'jml_hal' => null,
                    'information' => $request->information,
                    'updated_by' => auth()->user()->name,
                ]);

                DB::commit();
                return redirect()->route('incommingmail.index')->with(['success' => 'Sukses Ubah Data']);
            } catch (Throwable $th) {
                DB::rollback();
                return redirect()->back()->with(['fail' => 'Gagal Ubah Data!']);
            }
        }
        else {
            return redirect()->route('incommingmail.index')->with(['info' => 'Tidak ada perubahan, data sama dengan yang sebelumnya']);
        }
    }

    public function checkChanges()
    {
        $firstque = QueNumbIncMail::count();
        sleep(3);
        $secondque = QueNumbIncMail::count();
        $changes = ($firstque != $secondque);

        return response()->json(['changes' => $changes]);
    }
    public function checkChangeUpdate()
    {
        $firstTimestamp = IncommingMail::max('updated_at');
        sleep(3);
        $secondTimestamp = IncommingMail::max('updated_at');
        $changes = ($firstTimestamp != $secondTimestamp);

        return response()->json(['changes' => $changes]);
    }


    //LITNADIN
    public function indexLitnadin(Request $request)
    {
        // Initiate Variable Filter
        $entry_date = $request->get('entry_date');
        $mail_date = $request->get('mail_date');
        $mail_number = $request->get('mail_number');
        $status = $request->get('status');
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::get();
        $org_unit = $request->get('org_unit');
        $jmlHal = $request->get('jmlHal');

        $complains = Complain::get();
        $letters = Letter::get();
        $jmlHals = Dropdown::where('category', 'Jumlah Halaman')->get();
        $sators = Sator::orderBy('sator_name','asc')->get();

        $datas = IncommingMail::select('incomming_mails.*', 'incomming_mails.updated_at as last_update', 'incomming_mails.created_at as created', 'master_unit_letter.unit_name', 'master_sub_sator.sub_sator_name')
            ->leftjoin('master_sub_sator', 'incomming_mails.sub_org_unit', 'master_sub_sator.id')
            ->leftjoin('master_unit_letter', 'incomming_mails.mail_unit', 'master_unit_letter.id')
            ->where('placeman', 'LITNADIN')
            ->orderBy('created_at', 'desc');

        // FIlter
        if ($entry_date != null) {
            $datas->where('incomming_mails.entry_date', 'like', '%' . $entry_date . '%');
        }
        if ($mail_date != null) {
            $datas->where('incomming_mails.mail_date', 'like', '%' . $mail_date . '%');
        }
        if ($mail_number != null) {
            $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%');
        }
        if ($status != null) {
            $datas->where('status', $status);
        }
        if ($org_unit != null) {
            $datas->where('org_unit', $org_unit);
        }
        if ($jmlHal != null) {
            if ($jmlHal == '1-3') {
                $datas->whereBetween('incomming_mails.jml_hal', [1, 3]);
            } elseif ($jmlHal == '4-20') {
                $datas->whereBetween('incomming_mails.jml_hal', [4, 20]);
            } else {
                $datas->where('incomming_mails.jml_hal', '>', 20);
            }
        }
    
        // Get Query
        $datas = $datas->get();
        foreach($datas as $item){
            $countProgress = ProgressIncommingMail::where('id_incomming_mails', $item->id)->count();
            $progressStatus = ProgressIncommingMail::where('id_incomming_mails', $item->id)->get()->toArray();
            $item->progressStatus = $progressStatus;
            $item->countProgress = $countProgress;
        }
        // dd($datas);

        if ($request->ajax()) {
            $data = DataTables::of($datas)
            ->addColumn('action', function ($data) {
                return view('mail.incommingLitnadin.action', compact('data'));
            })
            ->toJson();
            return $data;
        }

        return view('mail.incommingLitnadin.index', compact('workunits', 'complains', 'letters',
            'entry_date', 'mail_date', 'mail_number', 'status', 'receiverMails', 'org_unit', 'jmlHal', 'jmlHals', 'sators'));
    }
    
    public function directupdateLitnadin(Request $request, $id)
    {
        $id = $id;

        if($request[1] != null){
            $date = new DateTime($request[1]);
            $dateVal = $date->format('Y-m-d H:i:s');
        } else {
            $dateVal = null;
        }

        // Check With Data Before
        $databefore = IncommingMail::where('id', $id)->first();
        $databefore->mail_date = $dateVal;
        $databefore->mail_number = $request[2];
        // $databefore->sender = $request[3];
        $databefore->mail_regarding = $request[4];
        $databefore->receiver = $request[5];
        $databefore->attachment_text = $request[6];

        if($databefore->isDirty()){
            DB::beginTransaction();
            try {
                if($request[6] != null){
                    $jmlHal = $databefore->mail_quantity + $request[6];
                } else {
                    $jmlHal = $databefore->mail_quantity;
                }
                
                // Update Incomming Mail
                IncommingMail::where('id', $id)->update([
                    'mail_date' => $request[1],
                    'mail_number' => $request[2],
                    // 'sender' => $request[3],
                    'mail_regarding' => $request[4],
                    'receiver' => $request[5],
                    'attachment_text' => $request[6],
                    'jml_hal' => $jmlHal,
                    'updated_by' => auth()->user()->name,
                ]);
    
                DB::commit();
                return response()->json(['success' => true]);
            } catch (Throwable $th) {
                DB::rollback();
                return response()->json(['success' => false]);
            }
        }
        else {
            return response()->json(['success' => "Same"]);
        }
    }

    public function rekapitulasiLitnadin(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $mail_number = $request->get('mail_number');
        $status = $request->get('status');
        $letter = $request->get('letter');
        
        $letters = Letter::get();
        
        if (isset($startdate) || isset($enddate) || isset($mail_number) || isset($status) || isset($letter)) 
        {
            $datas = IncommingMail::select('incomming_mails.*', 'incomming_mails.updated_at as last_update', 'master_unit_letter.unit_name', 'master_sub_sator.sub_sator_name')
            ->leftjoin('master_sub_sator', 'incomming_mails.sub_org_unit', 'master_sub_sator.id')
            ->leftjoin('master_unit_letter', 'incomming_mails.mail_unit', 'master_unit_letter.id')
            ->where('placeman', 'LITNADIN')
            ->orderBy('created_at', 'desc');

            // Filter
            if ($startdate != null) {
                $startdatesearch = (new DateTime($startdate))->format('Y-m-d H:i:s');
                $datas->where(function ($query) use ($startdatesearch) {
                    $query->where('incomming_mails.mail_date', '>=', $startdatesearch)
                        ->orWhere('incomming_mails.entry_date', '>=', $startdatesearch);
                });
            }
            if ($enddate != null) {
                $enddatesearch = (new DateTime($enddate))->format('Y-m-d H:i:s');
                $datas->where(function ($query) use ($enddatesearch) {
                    $query->where('incomming_mails.mail_date', '<=', $enddatesearch)
                        ->orWhere('incomming_mails.entry_date', '<=', $enddatesearch);
                });
            }
            if ($mail_number != null) {
                // $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%');

                $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.agenda_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.mail_regarding', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.information', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.sub_sator_name', 'like', '%' . $mail_number . '%');
            }
            if ($status != null) {
                $datas->where('incomming_mails.status', $status);
            }
            if ($letter != null) {
                $datas->where('incomming_mails.id_mst_letter', $letter);
            }
        
            // Get Query
            $datas = $datas->get();

        } else {
            $datas = [];
        }

        if ($request->ajax()) {
            $data = DataTables::of($datas)->toJson();
            return $data;
        }

        return view('mail.incommingLitnadin.rekapitulasi', compact('letters',
            'datas', 'startdate', 'enddate', 'mail_number', 'status', 'letter'));
    }

    public function rekapitulasiPrintLitnadin(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $mail_number = $request->get('mail_number');
        $status = $request->get('status');
        $letter = $request->get('letter');
        
        if (isset($startdate) || isset($enddate) || isset($mail_number) || isset($status) || isset($letter)) 
        {
            $datas = IncommingMail::select('incomming_mails.*', 'incomming_mails.updated_at as last_update', 'master_unit_letter.unit_name', 'master_sub_sator.sub_sator_name')
            ->leftjoin('master_sub_sator', 'incomming_mails.sub_org_unit', 'master_sub_sator.id')
            ->leftjoin('master_unit_letter', 'incomming_mails.mail_unit', 'master_unit_letter.id')
            ->where('placeman', 'LITNADIN')
            ->orderBy('created_at', 'desc');

            // Filter
            if ($startdate != null) {
                $startdatesearch = (new DateTime($startdate))->format('Y-m-d H:i:s');
                $datas->where(function ($query) use ($startdatesearch) {
                    $query->where('incomming_mails.mail_date', '>=', $startdatesearch)
                        ->orWhere('incomming_mails.entry_date', '>=', $startdatesearch);
                });
            }
            if ($enddate != null) {
                $enddatesearch = (new DateTime($enddate))->format('Y-m-d H:i:s');
                $datas->where(function ($query) use ($enddatesearch) {
                    $query->where('incomming_mails.mail_date', '<=', $enddatesearch)
                        ->orWhere('incomming_mails.entry_date', '<=', $enddatesearch);
                });
            }
            if ($mail_number != null) {
                // $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%');

                $datas->where('incomming_mails.mail_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.agenda_number', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.mail_regarding', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.information', 'like', '%' . $mail_number . '%')
                    ->orWhere('incomming_mails.sub_sator_name', 'like', '%' . $mail_number . '%');
            }
            if ($status != null) {
                $datas->where('incomming_mails.status', $status);
            }
            if ($letter != null) {
                $datas->where('incomming_mails.id_mst_letter', $letter);
            }
        
            // Get Query
            $datas = $datas->get();

        } else {
            $datas = [];
        }

        $now=Carbon::now()->format('YmdHis');
        
        $pdf = PDF::loadView('pdf.rekapitulasi-suratmasukLitnadin', [
            'startdate' => $startdate,
            'enddate' => $enddate,
            'print_date' => $now,
            'user' => auth()->user()->name,
            'datas' => $datas,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Print Rekapitulasi Surat Masuk (Litnadin).pdf', array("Attachment" => false));

    }

    public function createLitnadin(Request $request)
    {
        $letters = Letter::get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::get();
        // Surat Masuk Kategori 1 & 3
        // $unitletters = UnitLetter::whereIn('category', ['1', '3'])->get();
        // Surat Masuk Litnadin Lembar
        $unitletters = UnitLetter::where('unit_name', 'Lembar')->get();
        $classifications = Classification::get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();

        $sators = Sator::orderBy('sator_name','asc')->get();

        return view('mail.incommingLitnadin.create', compact('letters', 'workunits', 'receiverMails', 'unitletters', 'classifications', 'results', 'approveds',
            'sators'));
    }

    public function storeLitnadin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "placeman" => "required",
            "mail_regarding" => "required",
            "entry_date" => "required",
            "receiver" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
        ], 
        [
            'placeman.required' => 'Pejabat / Naskah Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'entry_date.required' => 'Tanggal Masuk Wajib Untuk Diisi.',
            'receiver.required' => 'Penerima Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
        ]);

        DB::beginTransaction();
        try {
            // Store Incoming Mail Litnadin
            // $sender = $request->senderSelect;
            $mail_type = null;
            $result = $request->result;
            $approved_by = $request->approved_by;
            $received_via = $request->received_viaInput;

            if($request->attachment_text != null){
                $jmlHal = $request->mail_quantity + $request->attachment_text;
            } else {
                $jmlHal = $request->mail_quantity;
            }
            
            $store = IncommingMail::create([
                'placeman' => $request->placeman,
                'id_mst_letter' => $request->id_mst_letter,
                'id_mst_complain' => $request->id_mst_complain,
                'org_unit' => $request->org_unit,
                'sub_org_unit' => $request->sub_org_unit,
                // 'sender' => $sender,
                'mail_number' => $request->mail_number,
                'mail_regarding' => $request->mail_regarding,
                'entry_date' => $request->entry_date,
                'mail_date' => $request->mail_date,
                'receiver' => $request->receiver,
                'mail_quantity' => $request->mail_quantity,
                'mail_unit' => $request->mail_unit,
                // 'archive_classification' => $request->archive_classification,
                // 'mail_retention_from' => $request->mail_retention_from,
                // 'mail_retention_to' => $request->mail_retention_to,
                'mail_type' => $mail_type,
                'result' => $result,
                'approved_by' => $approved_by,
                'received_via' => $received_via,
                'attachment_text' => $request->attachment_text,
                'information' => $request->information,
                'jml_hal' => $jmlHal,
                'status' => $request->status,
                'created_by' => auth()->user()->name,
            ]);

            // Register Que
            QueNumbIncMail::create([
                'id_mail' => $store->id,
                'id_mst_letter' => $request->id_mst_letter
            ]);

            DB::commit();
            return redirect()->route('incommingmail.indexLitnadin')->with(['success' => 'Sukses Tambah Data']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data!']);
        }
    }

    public function createbulkLitnadin(Request $request)
    {
        $letters = Letter::get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::get();
        // Surat Masuk Kategori 1 & 3
        // $unitletters = UnitLetter::whereIn('category', ['1', '3'])->get();
        // Surat Masuk Litnadin Lembar
        $unitletters = UnitLetter::where('unit_name', 'Lembar')->get();
        $classifications = Classification::get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();

        $sators = Sator::orderBy('sator_name','asc')->get();

        return view('mail.incommingLitnadin.createbulk', compact('letters', 'workunits', 'receiverMails', 'unitletters', 'classifications', 'results', 'approveds',
            'sators'));
    }
    
    public function storebulkLitnadin(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "placeman" => "required",
            "mail_regarding" => "required",
            "entry_date" => "required",
            "receiver" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
        ], 
        [
            'placeman.required' => 'Pejabat / Naskah Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'entry_date.required' => 'Tanggal Masuk Wajib Untuk Diisi.',
            'receiver.required' => 'Penerima Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
        ]);

        $amountLetter = $request->amount_letter;
        
        DB::beginTransaction();
        try {
            // $sender = $request->senderSelect;
            $mail_type = null;
            $result = $request->result;
            $approved_by = $request->approved_by;
            $received_via = $request->received_viaInput;

            if($request->attachment_text != null){
                $jmlHal = $request->mail_quantity + $request->attachment_text;
            } else {
                $jmlHal = $request->mail_quantity;
            }

            for ($i = 0; $i < $amountLetter; $i++) {
                
                $store = IncommingMail::create([
                    'placeman' => $request->placeman,
                    'id_mst_letter' => $request->id_mst_letter,
                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'id_mst_complain' => $request->id_mst_complain,
                    // 'sender' => $sender,
                    'mail_number' => $request->mail_number,
                    'mail_regarding' => $request->mail_regarding,
                    'entry_date' => $request->entry_date,
                    'mail_date' => $request->mail_date,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    // 'archive_classification' => $request->archive_classification,
                    // 'mail_retention_from' => $request->mail_retention_from,
                    // 'mail_retention_to' => $request->mail_retention_to,
                    'mail_type' => $mail_type,
                    'result' => $result,
                    'approved_by' => $approved_by,
                    'received_via' => $received_via,
                    'attachment_text' => $request->attachment_text,
                    'information' => $request->information,
                    'jml_hal' => $jmlHal,
                    'status' => $request->status,
                    'created_by' => auth()->user()->name,
                ]);

                // Register Que
                QueNumbIncMail::create([
                    'id_mail' => $store->id,
                    'id_mst_letter' => $request->id_mst_letter
                ]);
            }

            DB::commit();
            return redirect()->route('incommingmail.indexLitnadin')->with(['success' => 'Sukses Tambah Data (Bulk) Dengan Jumlah : '.$amountLetter.'']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data (Bulk)!']);
        }
    }
    
    public function detailLitnadin($id)
    {
        $id = decrypt($id);
        // dd($id);

        $data = IncommingMail::select('incomming_mails.*', 'master_letter.let_name', 'master_complain.com_name', 'receiv.work_name as receiver_name',
            'master_unit_letter.unit_name', 'master_classification.classification_name', 'org.sator_name', 'suborg.sub_sator_name'
        )
            ->leftjoin('master_letter', 'master_letter.id', 'incomming_mails.id_mst_letter')
            ->leftjoin('master_complain', 'master_complain.id', 'incomming_mails.id_mst_complain')
            ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'incomming_mails.mail_unit')
            ->leftjoin('master_sator as org', 'org.id', 'incomming_mails.org_unit')
            ->leftjoin('master_sub_sator as suborg', 'suborg.id', 'incomming_mails.sub_org_unit')
            ->leftjoin('master_workunit as receiv', 'receiv.id', 'incomming_mails.receiver')
            ->leftjoin('master_classification', 'master_classification.id', 'incomming_mails.archive_classification')
            ->where('incomming_mails.id', $id)
            ->first();

        return view('mail.incommingLitnadin.info', compact('data'));
    }
    
    public function editLitnadin(Request $request, $id)
    {
        $id = decrypt($id);

        $letters = Letter::get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::get();
        $unitletters = UnitLetter::get();
        $classifications = Classification::get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();

        $sators = Sator::orderBy('sator_name','asc')->get();

        $data = IncommingMail::select('incomming_mails.*', 'master_letter.let_name', 'master_complain.com_name', 'receiv.work_name as receiver_name',
            'master_unit_letter.unit_name', 'master_classification.classification_name'
        )
            ->leftjoin('master_letter', 'master_letter.id', 'incomming_mails.id_mst_letter')
            ->leftjoin('master_complain', 'master_complain.id', 'incomming_mails.id_mst_complain')
            ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'incomming_mails.mail_unit')
            ->leftjoin('master_workunit as receiv', 'receiv.id', 'incomming_mails.receiver')
            ->leftjoin('master_classification', 'master_classification.id', 'incomming_mails.archive_classification')
            ->where('incomming_mails.id', $id)
            ->first();

        return view('mail.incommingLitnadin.edit', compact('letters', 'receiverMails', 'workunits', 'unitletters', 'classifications',
            'results', 'approveds', 'sators', 'data'));
    }
    
    public function updateLitnadin(Request $request, $id)
    {
        $id = decrypt($id);
        //dd($id);

        $request->validate([
            "placeman" => "required",
            "mail_regarding" => "required",
            "entry_date" => "required",
            "receiver" => "required",
            "mail_quantity" => "required",
            "mail_unit" => "required",
        ], 
        [
            'placeman.required' => 'Pejabat / Naskah Wajib Untuk Diisi.',
            'mail_regarding.required' => 'Perihal Wajib Untuk Diisi.',
            'entry_date.required' => 'Tanggal Masuk Wajib Untuk Diisi.',
            'receiver.required' => 'Penerima Wajib Untuk Diisi.',
            'mail_quantity.required' => 'Jumlah Surat Wajib Untuk Diisi.',
            'mail_unit.required' => 'Satuan Surat Wajib Untuk Diisi.',
        ]);

        $entry_date = (new DateTime($request->entry_date))->format('Y-m-d H:i:s');
        if($request->mail_date != null)
            $mail_date = (new DateTime($request->mail_date))->format('Y-m-d H:i:s');
        else {
            $mail_date = null;
        }
        // $mail_retention_from = (new DateTime($request->mail_retention_from))->format('Y-m-d H:i:s');
        // $mail_retention_to = (new DateTime($request->mail_retention_to))->format('Y-m-d H:i:s');
        
        // $sender = $request->senderSelect;
        $mail_type = null;
        $result = $request->result;
        $approved_by = $request->approved_by;
        $received_via = $request->received_viaInput;

        // Check With Data Before
        $databefore = IncommingMail::where('id', $id)->first();
        
        $databefore->result = $result;
        $databefore->approved_by = $approved_by;

        // $databefore->sender = $sender;
        $databefore->org_unit = $request->org_unit;
        $databefore->sub_org_unit = $request->sub_org_unit;
        $databefore->mail_number = $request->mail_number;
        $databefore->mail_regarding = $request->mail_regarding;
        $databefore->entry_date = $entry_date;
        $databefore->mail_date = $mail_date;
        $databefore->receiver = $request->receiver;
        $databefore->mail_quantity = $request->mail_quantity;
        $databefore->mail_unit = $request->mail_unit;
        // $databefore->archive_classification = $request->archive_classification;
        // $databefore->mail_retention_from = $mail_retention_from;
        // $databefore->mail_retention_to = $mail_retention_to;
        $databefore->received_via = $received_via;
        $databefore->attachment_text = $request->attachment_text;
        $databefore->information = $request->information;
        $databefore->status = $request->status;

        if($request->attachment_text != null){
            $jmlHal = $request->mail_quantity + $request->attachment_text;
        } else {
            $jmlHal = $request->mail_quantity;
        }

        if($databefore->isDirty()){
            DB::beginTransaction();
            try {
                IncommingMail::where('id', $id)->update([
                    'id_mst_letter' => $request->id_mst_letter,
                    'id_mst_complain' => $request->id_mst_complain,
                    // 'sender' => $sender,
                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'mail_number' => $request->mail_number,
                    'mail_regarding' => $request->mail_regarding,
                    'entry_date' => $request->entry_date,
                    'mail_date' => $request->mail_date,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    // 'archive_classification' => $request->archive_classification,
                    // 'mail_retention_from' => $request->mail_retention_from,
                    // 'mail_retention_to' => $request->mail_retention_to,
                    'mail_type' => $mail_type,
                    'result' => $result,
                    'approved_by' => $approved_by,
                    'received_via' => $received_via,
                    'attachment_text' => $request->attachment_text,
                    'jml_hal' => $jmlHal,
                    'status' => $request->status,
                    'information' => $request->information,
                    'updated_by' => auth()->user()->name,
                ]);

                DB::commit();
                return redirect()->route('incommingmail.indexLitnadin')->with(['success' => 'Sukses Ubah Data']);
            } catch (Throwable $th) {
                DB::rollback();
                return redirect()->back()->with(['fail' => 'Gagal Ubah Data!']);
            }
        }
        else {
            return redirect()->route('incommingmail.indexLitnadin')->with(['info' => 'Tidak ada perubahan, data sama dengan yang sebelumnya']);
        }
    }

    public function createProgressLitnadin(Request $request, $id)
    {
        $id = decrypt($id);

        $request->validate([
            "information" => "required",
            "status" => "required",
        ], 
        [
            'information.required' => 'Keterangan Wajib Untuk Diisi.',
            'status.required' => 'Status Wajib Untuk Diisi.',
        ]);

        DB::beginTransaction();
        try {
            // Update Incomming Mail
            IncommingMail::where('id', $id)->update([
                'information' => $request->information,
                'status' => $request->status,
                'updated_by' => auth()->user()->name,
            ]);

            // Create Progress
            ProgressIncommingMail::create([
                'id_incomming_mails' => $id,
                'information' => $request->information,
                'status' => $request->status,
                'created_by' => auth()->user()->name,
            ]);

            DB::commit();
            return redirect()->route('incommingmail.indexLitnadin')->with(['success' => 'Sukses Ubah Data']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Ubah Data!']);
        }
    }
}
