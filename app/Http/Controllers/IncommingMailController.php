<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use DateTime;
use PDF;

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
        $letter = $request->get('letter');
        $complain = $request->get('complain');
        $org_unit = $request->get('org_unit');
        $idUpdated = $request->get('idUpdated');

        // Master Dropdown 
        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $letters = Letter::get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $complains = Complain::get();
        $sators = Sator::orderBy('sator_name', 'asc')->get();
        $workunits = WorkUnit::get();

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
        if ($letter != null) {
            $datas->where('incomming_mails.id_mst_letter', $letter);
        }
        if ($complain != null) {
            $datas->where('incomming_mails.id_mst_complain', $complain);
        }
        if ($org_unit != null) {
            $datas->where('org_unit', $org_unit);
        }

        // Get Query
        $datas = $datas->get();
        // Get Page Number
        $page_number = 1;
        if ($idUpdated) {
            $page_size = 10;
            $item = $datas->firstWhere('id', $idUpdated);
            if ($item) {
                $index = $datas->search(function ($value) use ($idUpdated) {
                    return $value->id == $idUpdated;
                });
                $page_number = (int) ceil(($index + 1) / $page_size);
            } else {
                $page_number = 1;
            }
        }
        // Get Last Update Database
        $lastUpdated = $datas->isNotEmpty() ? $datas->max('updated_at')->toDateTimeString() : null;

        if ($request->ajax()) {
            return DataTables::of($datas)->addColumn('action', function ($data) {
                return view('mail.incomming.action', compact('data'));
            })->toJson();
        }

        return view('mail.incomming.index', compact(
            'entry_date',
            'mail_date',
            'mail_number',
            'placeman',
            'letter',
            'complain',
            'org_unit',
            'placemans',
            'letters',
            'letters',
            'receiverMails',
            'complains',
            'sators',
            'workunits',
            'idUpdated',
            'page_number',
            'lastUpdated',
        ));
    }

    public function directupdate(Request $request, $id)
    {
        $id = $id;
        $dateVal = $request[1] !== null ? (new DateTime($request[1]))->format('Y-m-d H:i:s') : null;

        // Check With Data Before
        $databefore = IncommingMail::where('id', $id)->first();
        $databefore->entry_date = $dateVal;
        $databefore->mail_number = $request[3];
        $databefore->sender = $request[4];
        $databefore->mail_regarding = $request[5];
        $databefore->receiver = $request[6];
        $databefore->mail_quantity = $request[7];
        $databefore->attachment_text = $request[8];
        $databefore->information = $request[9];

        if ($databefore->isDirty()) {
            DB::beginTransaction();
            try {
                // Update Incomming Mail
                IncommingMail::where('id', $id)->update([
                    'entry_date' => $request[1],
                    'mail_number' => $request[3],
                    'sender' => $request[4],
                    'mail_regarding' => $request[5],
                    'receiver' => $request[6],
                    'mail_quantity' => $request[7],
                    'attachment_text' => $request[8],
                    'information' => $request[9],
                    'updated_by' => auth()->user()->name,
                ]);
                $datas = IncommingMail::where('placeman', '!=', 'LITNADIN')->get();
                $lastUpdatedNow = $datas->isNotEmpty() ? $datas->max('updated_at')->toDateTimeString() : null;

                DB::commit();
                return response()->json(['success' => true, 'idUpdated' => $id, 'updatedAt' => $lastUpdatedNow]);
            } catch (Throwable $th) {
                DB::rollback();
                return response()->json(['success' => false, 'errors' => $th]);
            }
        } else {
            return response()->json(['success' => "Same"]);
        }
    }

    public function checkChangeIncomming(Request $request)
    {
        $lastUpdated = $request->input('lastUpdated');
        $datas = IncommingMail::where('placeman', '!=', 'LITNADIN')->get();
        $lastUpdatedNow = $datas->isNotEmpty() ? $datas->max('updated_at')->toDateTimeString() : null;
        $changes = ($lastUpdated != $lastUpdatedNow);
        return response()->json([
            'changes' => $changes,
            'lastUpdatedNow' => $lastUpdatedNow,
        ]);
    }

    public function rekapitulasi(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $mail_number = $request->get('mail_number');
        $placeman = $request->get('placeman');
        $letter = $request->get('letter');
        $complain = $request->get('complain');

        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $letters = Letter::get();
        $complains = Complain::get();

        if (isset($startdate) || isset($enddate) || isset($mail_number) || isset($placeman) || isset($letter) || isset($complain)) {
            // Fetch filters from request
            $filters = $request->only(['startdate', 'enddate', 'mail_number', 'placeman', 'letter', 'complain']);
            $datas = $this->getFilteredData($filters);
        } else {
            $datas = [];
        }

        if ($request->ajax()) {
            return DataTables::of($datas)->toJson();
        }

        return view('mail.incomming.rekapitulasi', compact(
            'startdate',
            'enddate',
            'mail_number',
            'placeman',
            'letter',
            'complain',
            'placemans',
            'letters',
            'complains',
            'datas',
        ));
    }

    public function rekapitulasiPrint(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $mail_number = $request->get('mail_number');
        $placeman = $request->get('placeman');
        $letter = $request->get('letter');
        $complain = $request->get('complain');

        if (isset($startdate) || isset($enddate) || isset($mail_number) || isset($placeman) || isset($letter) || isset($complain)) {
            // Fetch filters from request
            $filters = $request->only(['startdate', 'enddate', 'mail_number', 'placeman', 'letter', 'complain']);
            $datas = $this->getFilteredData($filters);
        } else {
            $datas = [];
        }

        $pdf = PDF::loadView('pdf.rekapitulasi.main', [
            'startdate' => $filters['startdate'] ?? null,
            'enddate' => $filters['enddate'] ?? null,
            'print_date' => Carbon::now()->format('YmdHis'),
            'user' => auth()->user()->name,
            'datas' => $datas,
            'mailType' => 'Surat Masuk',
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Print Rekapitulasi Surat Masuk.pdf', ["Attachment" => false]);
    }

    private function getFilteredData($filters)
    {
        $datas = IncommingMail::select(
            'incomming_mails.*',
            'incomming_mails.updated_at as last_update',
            'master_unit_letter.unit_name',
            'master_sub_sator.sub_sator_name'
        )
            ->leftJoin('master_sub_sator', 'incomming_mails.sub_org_unit', 'master_sub_sator.id')
            ->leftJoin('master_unit_letter', 'incomming_mails.mail_unit', 'master_unit_letter.id')
            ->where('placeman', '!=', 'LITNADIN')
            ->orderBy('created_at', 'asc');

        if (!empty($filters['startdate'])) {
            $startdatesearch = (new DateTime($filters['startdate']))->format('Y-m-d H:i:s');
            $datas->where(function ($query) use ($startdatesearch) {
                $query->where('incomming_mails.mail_date', '>=', $startdatesearch)
                    ->orWhere('incomming_mails.entry_date', '>=', $startdatesearch);
            });
        }
        if (!empty($filters['enddate'])) {
            $enddatesearch = (new DateTime($filters['enddate']))->format('Y-m-d H:i:s');
            $datas->where(function ($query) use ($enddatesearch) {
                $query->where('incomming_mails.mail_date', '<=', $enddatesearch)
                    ->orWhere('incomming_mails.entry_date', '<=', $enddatesearch);
            });
        }
        if (!empty($filters['mail_number'])) {
            $datas->where(function ($query) use ($filters) {
                $query->where('incomming_mails.mail_number', 'like', '%' . $filters['mail_number'] . '%')
                    ->orWhere('incomming_mails.agenda_number', 'like', '%' . $filters['mail_number'] . '%')
                    ->orWhere('incomming_mails.mail_regarding', 'like', '%' . $filters['mail_number'] . '%')
                    ->orWhere('incomming_mails.information', 'like', '%' . $filters['mail_number'] . '%')
                    ->orWhere('sub_sator_name', 'like', '%' . $filters['mail_number'] . '%');
            });
        }
        if (!empty($filters['placeman'])) {
            $datas->where('incomming_mails.placeman', $filters['placeman']);
        }
        if (!empty($filters['letter'])) {
            $datas->where('incomming_mails.id_mst_letter', $filters['letter']);
        }
        if (!empty($filters['complain'])) {
            $datas->where('incomming_mails.id_mst_complain', $filters['complain']);
        }
        return $datas->get();
    }

    public function create(Request $request)
    {
        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $complains = Complain::where('is_active', 1)->get();
        $letters = Letter::where('is_active', 1)->get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::where('is_active', 1)->get();
        // Surat Masuk Kategori 1 & 3
        $unitletters = UnitLetter::whereIn('category', ['1', '3'])->where('is_active', 1)->get();
        $classifications = Classification::get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();
        $mailtypes = Dropdown::where('category', 'Jenis Surat')->get();
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();

        $sators = Sator::orderBy('sator_name', 'asc')->where('is_active', 1)->get();

        return view('mail.incomming.create', compact(
            'placemans',
            'complains',
            'letters',
            'workunits',
            'receiverMails',
            'unitletters',
            'classifications',
            'results',
            'approveds',
            'mailtypes',
            'receivedvias',
            'sators'
        ));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                "placeman" => "required",
                "mail_regarding" => "required",
                "entry_date" => "required",
                "receiver" => "required",
                "mail_quantity" => "required",
                "mail_unit" => "required",
                "id_mst_letter" => "required_unless:placeman,PENGADUAN",
                "id_mst_complain" => "required_if:placeman,PENGADUAN",
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
            ]
        );

        DB::beginTransaction();
        try {
            // Store Outgoing Mail
            $maxOrderNumber = IncommingMail::max('no_order');
            $nextOrderNumber = $maxOrderNumber ? ((int) $maxOrderNumber + 1) : 1;
            $store = IncommingMail::create([
                'no_order' => $nextOrderNumber,
                'placeman' => $request->placeman,
                'id_mst_letter' => $request->id_mst_letter,
                'id_mst_complain' => $request->id_mst_complain,
                'org_unit' => $request->org_unit,
                'sub_org_unit' => $request->sub_org_unit,
                'sender' => $request->senderInput,
                'mail_number' => $request->mail_number,
                'mail_regarding' => $request->mail_regarding,
                'entry_date' => $request->entry_date,
                'mail_date' => $request->mail_date,
                'receiver' => $request->receiver,
                'mail_quantity' => $request->mail_quantity,
                'mail_unit' => $request->mail_unit,
                'mail_type' => $request->mail_type,
                'received_via' => $request->received_viaSelect,
                'attachment_text' => $request->attachment_text,
                'information' => $request->information,
                'created_by' => auth()->user()->name,
            ]);
            // Register Que
            QueNumbIncMail::create([
                'id_mail' => $store->id,
                'id_mst_letter' => ($request->placeman == "PENGADUAN") ? 0 : $request->id_mst_letter
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
        $complains = Complain::where('is_active', 1)->get();
        $letters = Letter::where('is_active', 1)->get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::where('is_active', 1)->get();
        // Surat Masuk Kategori 1 & 3
        $unitletters = UnitLetter::whereIn('category', ['1', '3'])->where('is_active', 1)->get();
        $classifications = Classification::get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();
        $mailtypes = Dropdown::where('category', 'Jenis Surat')->get();
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();

        $sators = Sator::orderBy('sator_name', 'asc')->where('is_active', 1)->get();

        return view('mail.incomming.createbulk', compact(
            'placemans',
            'complains',
            'letters',
            'workunits',
            'receiverMails',
            'unitletters',
            'classifications',
            'results',
            'approveds',
            'mailtypes',
            'receivedvias',
            'sators'
        ));
    }

    public function storebulk(Request $request)
    {
        $request->validate(
            [
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
            ]
        );

        $amountLetter = $request->amount_letter;

        DB::beginTransaction();
        try {
            $maxOrderNumber = IncommingMail::max('no_order');
            $nextOrderNumber = $maxOrderNumber ? ((int) $maxOrderNumber + 1) : 1;
            for ($i = 0; $i < $amountLetter; $i++) {
                // Store Outgoing Mail
                $store = IncommingMail::create([
                    'no_order' => $nextOrderNumber,
                    'placeman' => $request->placeman,
                    'id_mst_letter' => $request->id_mst_letter,
                    'id_mst_complain' => $request->id_mst_complain,
                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'sender' => $request->senderInput,
                    'mail_number' => $request->mail_number,
                    'mail_regarding' => $request->mail_regarding,
                    'entry_date' => $request->entry_date,
                    'mail_date' => $request->mail_date,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    'mail_type' => $request->mail_type,
                    'received_via' => $request->received_viaSelect,
                    'attachment_text' => $request->attachment_text,
                    'information' => $request->information,
                    'created_by' => auth()->user()->name,
                ]);
                // Register Que
                QueNumbIncMail::create([
                    'id_mail' => $store->id,
                    'id_mst_letter' => ($request->placeman == "PENGADUAN") ? 0 : $request->id_mst_letter
                ]);
                $nextOrderNumber++;
            }

            DB::commit();
            return redirect()->route('incommingmail.index')->with(['success' => 'Sukses Tambah Data (Bulk) Dengan Jumlah : ' . $amountLetter . '']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data (Bulk)!']);
        }
    }

    public function detail($id)
    {
        $id = decrypt($id);

        $data = IncommingMail::select(
            'incomming_mails.*',
            'master_letter.let_name',
            'master_complain.com_name',
            'receiv.work_name as receiver_name',
            'master_unit_letter.unit_name',
            'master_classification.classification_name',
            'org.sator_name',
            'suborg.sub_sator_name'
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

        return view('mail.incomming.info', compact('data', 'id'));
    }

    public function edit(Request $request, $id)
    {
        $id = decrypt($id);

        $placemans = Dropdown::where('category', 'Pejabat / Naskah')->get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();
        $mailtypes = Dropdown::where('category', 'Jenis Surat')->get();
        $receivedvias = Dropdown::where('category', 'Diterima Via')->get();

        // GET MASTER
        $complains = Complain::where('is_active', 1)->get();
        $letters = Letter::where('is_active', 1)->get();
        $unitletters = UnitLetter::whereIn('category', ['1', '3'])->where('is_active', 1)->get(); // Surat Masuk Kategori 1 & 3
        $sators = Sator::orderBy('sator_name', 'asc')->where('is_active', 1)->get();

        $dataEdit = IncommingMail::where('id', $id)->first();
        // Fetch the corresponding additional data
        $complainsData = Complain::where('id', $dataEdit->id_mst_complain)->first();
        $lettersData = Letter::where('id', $dataEdit->id_mst_letter)->first();
        $unitlettersData = UnitLetter::where('id', $dataEdit->mail_unit)->first();
        $satorsData = Sator::where('id', $dataEdit->org_unit)->first();
        // Merge the original collections with the additional data if not null, and remove duplicates based on 'id'
        $complains = $complainsData ? $complains->merge([$complainsData])->unique('id') : $complains;
        $letters = $lettersData ? $letters->merge([$lettersData])->unique('id') : $letters;
        $unitletters = $unitlettersData ? $unitletters->merge([$unitlettersData])->unique('id') : $unitletters;
        $sators = $satorsData ? $sators->merge([$satorsData])->unique('id') : $sators;

        $data = IncommingMail::select(
            'incomming_mails.*',
            'master_letter.let_name',
            'master_complain.com_name',
            'receiv.work_name as receiver_name',
            'master_unit_letter.unit_name',
            'master_classification.classification_name'
        )
            ->leftjoin('master_letter', 'master_letter.id', 'incomming_mails.id_mst_letter')
            ->leftjoin('master_complain', 'master_complain.id', 'incomming_mails.id_mst_complain')
            ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'incomming_mails.mail_unit')
            ->leftjoin('master_workunit as receiv', 'receiv.id', 'incomming_mails.receiver')
            ->leftjoin('master_classification', 'master_classification.id', 'incomming_mails.archive_classification')
            ->where('incomming_mails.id', $id)
            ->first();

        return view('mail.incomming.edit', compact(
            'placemans',
            'complains',
            'letters',
            'receiverMails',
            'unitletters',
            'results',
            'approveds',
            'mailtypes',
            'receivedvias',
            'sators',
            'data'
        ));
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);

        $request->validate(
            [
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
            ]
        );

        $entry_date = (new DateTime($request->entry_date))->format('Y-m-d H:i:s');
        $mail_date = $request->mail_date ? (new DateTime($request->mail_date))->format('Y-m-d H:i:s') : null;

        // Check With Data Before
        $databefore = IncommingMail::where('id', $id)->first();

        if ($databefore->placeman == 'PENGADUAN') {
            $databefore->id_mst_complain = $request->id_mst_complain;
        } else {
            $databefore->id_mst_letter = $request->id_mst_letter;
        }
        $databefore->mail_type = $request->mail_type;
        $databefore->placeman = $request->placeman;
        $databefore->sender = $request->senderInput;
        $databefore->org_unit = $request->org_unit;
        $databefore->sub_org_unit = $request->sub_org_unit;
        $databefore->mail_number = $request->mail_number;
        $databefore->mail_regarding = $request->mail_regarding;
        $databefore->entry_date = $entry_date;
        $databefore->mail_date = $mail_date;
        $databefore->receiver = $request->receiver;
        $databefore->mail_quantity = $request->mail_quantity;
        $databefore->mail_unit = $request->mail_unit;
        $databefore->received_via = $request->received_viaSelect;
        $databefore->attachment_text = $request->attachment_text;
        $databefore->information = $request->information;

        $redirectParams = [
            'entry_date' => $request->filt_entry_date,
            'mail_date' => $request->filt_mail_date,
            'mail_number' => $request->filt_mail_number,
            'placemans' => $request->filt_placeman,
            'letter' => $request->filt_letter,
            'complain' => $request->filt_complain,
            'org_unit' => $request->filt_org_unit,
            'idUpdated' => $id,
        ];

        if ($databefore->isDirty()) {
            DB::beginTransaction();
            try {
                IncommingMail::where('id', $id)->update([
                    'placeman' => $request->placeman,
                    'id_mst_letter' => $request->id_mst_letter,
                    'id_mst_complain' => $request->id_mst_complain,
                    'sender' => $request->senderInput,
                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'mail_number' => $request->mail_number,
                    'mail_regarding' => $request->mail_regarding,
                    'entry_date' => $request->entry_date,
                    'mail_date' => $request->mail_date,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    'mail_type' => $request->mail_type,
                    'received_via' => $request->received_viaSelect,
                    'attachment_text' => $request->attachment_text,
                    'information' => $request->information,
                    'updated_by' => auth()->user()->name,
                ]);

                DB::commit();

                return redirect()->route('incommingmail.index', $redirectParams)->with(['success' => 'Sukses Ubah Data']);
            } catch (Throwable $th) {
                DB::rollback();
                return redirect()->back()->with(['fail' => 'Gagal Ubah Data!']);
            }
        } else {
            return redirect()->route('incommingmail.index', $redirectParams)->with(['info' => 'Tidak ada perubahan, data sama dengan yang sebelumnya']);
        }
    }


    //LITNADIN
    public function indexLitnadin(Request $request)
    {
        // Initiate Variable Filter
        $entry_date = $request->get('entry_date');
        $mail_date = $request->get('mail_date');
        $mail_number = $request->get('mail_number');
        $litnadin_number = $request->get('litnadin_number');
        $org_unit = $request->get('org_unit');
        $letter = $request->get('letter');
        $receiver = $request->get('receiver');
        $jmlHal = $request->get('jmlHal');
        $status = $request->get('status');
        $idUpdated = $request->get('idUpdated');
        // Master Dropdown
        $sators = Sator::orderBy('sator_name', 'asc')->get();
        $letters = Letter::get();
        $jmlHals = Dropdown::where('category', 'Jumlah Halaman')->get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();

        $datas = IncommingMail::select(
            'incomming_mails.*',
            'incomming_mails.updated_at as last_update',
            'incomming_mails.created_at as created',
            'master_unit_letter.unit_name',
            'master_sub_sator.sub_sator_name',
            DB::raw('(SELECT COUNT(*) FROM progress_incomming_mails WHERE progress_incomming_mails.id_incomming_mails = incomming_mails.id) as countProgress'),
            DB::raw('(SELECT JSON_ARRAYAGG(JSON_OBJECT(
                "id", id,
                "status", status,
                "updated_at", updated_at,
                "information", information
            )) FROM progress_incomming_mails WHERE progress_incomming_mails.id_incomming_mails = incomming_mails.id) as progressStatus')
        )
            ->leftJoin('master_sub_sator', 'incomming_mails.sub_org_unit', '=', 'master_sub_sator.id')
            ->leftJoin('master_unit_letter', 'incomming_mails.mail_unit', '=', 'master_unit_letter.id')
            ->where('placeman', 'LITNADIN')
            // Filter
            ->when($entry_date, function ($q) use ($entry_date) {
                $q->where('incomming_mails.entry_date', 'like', "%$entry_date%");
            })
            ->when($mail_date, function ($q) use ($mail_date) {
                $q->where('incomming_mails.mail_date', 'like', "%$mail_date%");
            })
            ->when($mail_number, function ($q) use ($mail_number) {
                $q->where('incomming_mails.mail_number', 'like', "%$mail_number%");
            })
            ->when($litnadin_number, function ($q) use ($litnadin_number) {
                $q->where('incomming_mails.litnadin_number', $litnadin_number);
            })
            ->when($org_unit, function ($q) use ($org_unit) {
                $q->where('org_unit', $org_unit);
            })
            ->when($letter, function ($q) use ($letter) {
                $q->where('incomming_mails.id_mst_letter', $letter);
            })
            ->when($receiver, function ($q) use ($receiver) {
                $q->where('incomming_mails.receiver', $receiver);
            })
            ->when($jmlHal, function ($q) use ($jmlHal) {
                if ($jmlHal === '1-3') {
                    $q->whereBetween('incomming_mails.jml_hal', [1, 3]);
                } elseif ($jmlHal === '4-20') {
                    $q->whereBetween('incomming_mails.jml_hal', [4, 20]);
                } else {
                    $q->where('incomming_mails.jml_hal', '>', 20);
                }
            })
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Get Page Number
        $page_number = 1;
        if ($idUpdated) {
            $page_size = 10;
            $item = $datas->firstWhere('id', $idUpdated);
            if ($item) {
                $index = $datas->search(function ($value) use ($idUpdated) {
                    return $value->id == $idUpdated;
                });
                $page_number = (int) ceil(($index + 1) / $page_size);
            } else {
                $page_number = 1;
            }
        }
        // Get Last Update Database
        $lastUpdated = $datas->isNotEmpty() ? $datas->max('updated_at')->toDateTimeString() : null;

        if ($request->ajax()) {
            return DataTables::of($datas)->addColumn('action', function ($data) {
                return view('mail.incommingLitnadin.action', compact('data'));
            })->toJson();
        }

        return view('mail.incommingLitnadin.index', compact(
            'entry_date',
            'mail_date',
            'mail_number',
            'litnadin_number',
            'org_unit',
            'letter',
            'receiver',
            'status',
            'jmlHal',
            'sators',
            'letters',
            'jmlHals',
            'receiverMails',
            'idUpdated',
            'page_number',
            'lastUpdated',
        ));
    }

    public function directupdateLitnadin(Request $request, $id)
    {
        $id = $id;
        $dateVal = $request[1] !== null ? (new DateTime($request[1]))->format('Y-m-d H:i:s') : null;

        // Check With Data Before
        $databefore = IncommingMail::where('id', $id)->first();
        $databefore->entry_date = $dateVal;
        $databefore->mail_number = $request[2];
        $databefore->mail_regarding = $request[4];
        $databefore->receiver = $request[5];
        $databefore->attachment_text = $request[6];

        if ($databefore->isDirty()) {
            DB::beginTransaction();
            try {
                $jmlHal = $databefore->mail_quantity + ($request[6] ?? 0);

                // Update Incomming Mail
                IncommingMail::where('id', $id)->update([
                    'entry_date' => $request[1],
                    'mail_number' => $request[2],
                    'mail_regarding' => $request[4],
                    'receiver' => $request[5],
                    'attachment_text' => $request[6],
                    'jml_hal' => $jmlHal,
                    'updated_by' => auth()->user()->name,
                ]);
                $datas = IncommingMail::where('placeman', 'LITNADIN')->get();
                $lastUpdatedNow = $datas->isNotEmpty() ? $datas->max('updated_at')->toDateTimeString() : null;

                DB::commit();
                return response()->json(['success' => true, 'idUpdated' => $id, 'updatedAt' => $lastUpdatedNow]);
            } catch (Throwable $th) {
                DB::rollback();
                return response()->json(['success' => false, 'errors' => $th]);
            }
        } else {
            return response()->json(['success' => "Same"]);
        }
    }

    public function checkChangeIncommingLitnadin(Request $request)
    {
        $lastUpdated = $request->input('lastUpdated');
        $datas = IncommingMail::where('placeman', 'LITNADIN')->get();
        $lastUpdatedNow = $datas->isNotEmpty() ? $datas->max('updated_at')->toDateTimeString() : null;
        $changes = ($lastUpdated != $lastUpdatedNow);
        return response()->json([
            'changes' => $changes,
            'lastUpdatedNow' => $lastUpdatedNow,
        ]);
    }

    public function rekapitulasiLitnadin(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $mail_number = $request->get('mail_number');
        $litnadin_number = $request->get('litnadin_number');
        $org_unit = $request->get('org_unit');
        $letter = $request->get('letter');
        $receiver = $request->get('receiver');
        $jmlHal = $request->get('jmlHal');
        $status = $request->get('status');
        $result = $request->get('result');

        $sators = Sator::orderBy('sator_name', 'asc')->get();
        $letters = Letter::get();
        $jmlHals = Dropdown::where('category', 'Jumlah Halaman')->get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();

        if (isset($startdate) || isset($enddate) || isset($mail_number) || isset($litnadin_number) || isset($letter) || isset($receiver) || isset($jmlHal) || isset($status)) {
            // Fetch filters from request
            $filters = $request->only(['startdate', 'enddate', 'mail_number', 'litnadin_number', 'org_unit', 'letter', 'receiver', 'jmlHal', 'status', 'result']);
            $datas = $this->getFilteredDataLitnadin($filters);
        } else {
            $datas = [];
        }

        if ($request->ajax()) {
            $data = DataTables::of($datas)->toJson();
            return $data;
        }

        return view('mail.incommingLitnadin.rekapitulasi', compact(
            'startdate',
            'enddate',
            'mail_number',
            'litnadin_number',
            'org_unit',
            'sators',
            'letter',
            'receiver',
            'jmlHal',
            'results',
            'status',
            'letters',
            'receiverMails',
            'jmlHals',
            'result',
            'datas',
        ));
    }

    public function rekapitulasiPrintLitnadin(Request $request)
    {
        // Initiate Variable Filter
        $startdate = $request->get('startdate');
        $enddate = $request->get('enddate');
        $mail_number = $request->get('mail_number');
        $litnadin_number = $request->get('litnadin_number');
        $letter = $request->get('letter');
        $receiver = $request->get('receiver');
        $jmlHal = $request->get('jmlHal');
        $status = $request->get('status');

        if (isset($startdate) || isset($enddate) || isset($mail_number) || isset($litnadin_number) || isset($letter) || isset($receiver) || isset($jmlHal) || isset($status)) {
            // Fetch filters from request
            $filters = $request->only(['startdate', 'enddate', 'mail_number', 'litnadin_number', 'letter', 'receiver', 'jmlHal', 'status']);
            $datas = $this->getFilteredDataLitnadin($filters);
        } else {
            $datas = [];
        }

        $pdf = PDF::loadView('pdf.rekapitulasi.main', [
            'startdate' => $filters['startdate'] ?? null,
            'enddate' => $filters['enddate'] ?? null,
            'print_date' => Carbon::now()->format('YmdHis'),
            'user' => auth()->user()->name,
            'datas' => $datas,
            'mailType' => 'Surat Masuk Litnadin',
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Print Rekapitulasi Surat Masuk (Litnadin).pdf', array("Attachment" => false));
    }

    private function getFilteredDataLitnadin($filters)
    {
        $datas = IncommingMail::select('incomming_mails.*', 'incomming_mails.updated_at as last_update', 'master_letter.let_name as jenis_naskah', 'master_unit_letter.unit_name', 'master_sub_sator.sub_sator_name')
            ->leftjoin('master_letter', 'incomming_mails.id_mst_letter', 'master_letter.id')
            ->leftjoin('master_sub_sator', 'incomming_mails.sub_org_unit', 'master_sub_sator.id')
            ->leftjoin('master_unit_letter', 'incomming_mails.mail_unit', 'master_unit_letter.id')
            ->where('placeman', 'LITNADIN')
            ->orderBy('created_at', 'asc');

        if (!empty($filters['startdate'])) {
            $startdatesearch = (new DateTime($filters['startdate']))->format('Y-m-d H:i:s');
            $datas->where(function ($query) use ($startdatesearch) {
                $query->where('incomming_mails.mail_date', '>=', $startdatesearch)
                    ->orWhere('incomming_mails.entry_date', '>=', $startdatesearch);
            });
        }
        if (!empty($filters['enddate'])) {
            $enddatesearch = (new DateTime($filters['enddate']))->format('Y-m-d H:i:s');
            $datas->where(function ($query) use ($enddatesearch) {
                $query->where('incomming_mails.mail_date', '<=', $enddatesearch)
                    ->orWhere('incomming_mails.entry_date', '<=', $enddatesearch);
            });
        }
        if (!empty($filters['mail_number'])) {
            $datas->where(function ($query) use ($filters) {
                $query->where('incomming_mails.mail_number', 'like', '%' . $filters['mail_number'] . '%')
                    ->orWhere('incomming_mails.agenda_number', 'like', '%' . $filters['mail_number'] . '%')
                    ->orWhere('incomming_mails.mail_regarding', 'like', '%' . $filters['mail_number'] . '%')
                    ->orWhere('incomming_mails.information', 'like', '%' . $filters['mail_number'] . '%')
                    ->orWhere('sub_sator_name', 'like', '%' . $filters['mail_number'] . '%');
            });
        }
        if (!empty($filters['litnadin_number'])) {
            $datas->where('incomming_mails.litnadin_number', $filters['litnadin_number']);
        }
        if (!empty($filters['org_unit'])) {
            $datas->where('incomming_mails.org_unit', $filters['org_unit']);
        }
        if (!empty($filters['letter'])) {
            $datas->where('incomming_mails.id_mst_letter', $filters['letter']);
        }
        if (!empty($filters['receiver'])) {
            // dd($filters['receiver']);
            $datas->where('incomming_mails.receiver', $filters['receiver']);
        }
        if (!empty($filters['jmlHal'])) {
            if ($filters['jmlHal'] == '1-3') {
                $datas->whereBetween('jml_hal', [1, 3]);
            } elseif ($filters['jmlHal'] == '4-20') {
                $datas->whereBetween('jml_hal', [4, 20]);
            } else {
                $datas->where('jml_hal', '>', 20);
            }
        }
        if (!empty($filters['status'])) {
            $datas->where('incomming_mails.status', $filters['status']);
        }
        if (!empty($filters['result'])) {
            $datas->where('incomming_mails.result', $filters['result']);
        }
        return $datas->get();
    }

    public function createLitnadin(Request $request)
    {
        $letters = Letter::where('is_active', 1)->get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::where('is_active', 1)->get();
        // Surat Masuk Litnadin Lembar
        $unitletters = UnitLetter::where('unit_name', 'Lembar')->where('is_active', 1)->get();
        $classifications = Classification::where('is_active', 1)->get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();
        $sators = Sator::orderBy('sator_name', 'asc')->where('is_active', 1)->get();

        return view('mail.incommingLitnadin.create', compact(
            'letters',
            'workunits',
            'receiverMails',
            'unitletters',
            'classifications',
            'results',
            'approveds',
            'sators'
        ));
    }

    public function storeLitnadin(Request $request)
    {
        $request->validate(
            [
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
            ]
        );

        DB::beginTransaction();
        try {
            // Store Incoming Mail Litnadin
            $jmlHal = $request->mail_quantity + ($request->attachment_text ?? 0);
            $maxLitnadinNumber = IncommingMail::max('litnadin_number');
            $nextLitnadinNumber = $maxLitnadinNumber ? ((int) $maxLitnadinNumber + 1) : 1;
            $store = IncommingMail::create([
                'litnadin_number' => $nextLitnadinNumber,
                'placeman' => $request->placeman,
                'id_mst_letter' => $request->id_mst_letter,
                'id_mst_complain' => $request->id_mst_complain,
                'org_unit' => $request->org_unit,
                'sub_org_unit' => $request->sub_org_unit,
                'sender' => $request->senderInput,
                'mail_number' => $request->mail_number,
                'mail_regarding' => $request->mail_regarding,
                'entry_date' => $request->entry_date,
                'mail_date' => $request->mail_date,
                'receiver' => $request->receiver,
                'mail_quantity' => $request->mail_quantity,
                'mail_unit' => $request->mail_unit,
                'result' => $request->result,
                'approved_by' => $request->approved_by,
                'received_via' => $request->received_viaInput,
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
        $letters = Letter::where('is_active', 1)->get();
        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $workunits = WorkUnit::where('is_active', 1)->get();
        // Surat Masuk Litnadin Lembar
        $unitletters = UnitLetter::where('unit_name', 'Lembar')->get();
        $classifications = Classification::where('is_active', 1)->get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();
        $sators = Sator::orderBy('sator_name', 'asc')->where('is_active', 1)->get();

        return view('mail.incommingLitnadin.createbulk', compact(
            'letters',
            'workunits',
            'receiverMails',
            'unitletters',
            'classifications',
            'results',
            'approveds',
            'sators'
        ));
    }

    public function storebulkLitnadin(Request $request)
    {
        $request->validate(
            [
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
            ]
        );

        DB::beginTransaction();
        try {
            $jmlHal = $request->mail_quantity + ($request->attachment_text ?? 0);
            $maxLitnadinNumber = IncommingMail::max('litnadin_number');
            $nextLitnadinNumber = $maxLitnadinNumber ? ((int) $maxLitnadinNumber + 1) : 1;
            $amountLetter = $request->amount_letter;

            for ($i = 0; $i < $amountLetter; $i++) {
                $store = IncommingMail::create([
                    'litnadin_number' => $nextLitnadinNumber,
                    'placeman' => $request->placeman,
                    'id_mst_letter' => $request->id_mst_letter,
                    'id_mst_complain' => $request->id_mst_complain,
                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'sender' => $request->senderInput,
                    'mail_number' => $request->mail_number,
                    'mail_regarding' => $request->mail_regarding,
                    'entry_date' => $request->entry_date,
                    'mail_date' => $request->mail_date,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    'result' => $request->result,
                    'approved_by' => $request->approved_by,
                    'received_via' => $request->received_viaInput,
                    'attachment_text' => $request->attachment_text,
                    'information' => $request->information,
                    'jml_hal' => $jmlHal,
                    'status' => $request->status,
                    'created_by' => auth()->user()->name,
                ]);
                $nextLitnadinNumber++;

                // Register Que
                QueNumbIncMail::create([
                    'id_mail' => $store->id,
                    'id_mst_letter' => $request->id_mst_letter
                ]);
            }

            DB::commit();
            return redirect()->route('incommingmail.indexLitnadin')->with(['success' => 'Sukses Tambah Data (Bulk) Dengan Jumlah : ' . $amountLetter . '']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->back()->with(['fail' => 'Gagal Tambah Data (Bulk)!']);
        }
    }

    public function detailLitnadin(Request $request, $id)
    {
        $id = decrypt($id);

        $data = IncommingMail::select(
            'incomming_mails.*',
            'master_letter.let_name',
            'master_complain.com_name',
            'receiv.work_name as receiver_name',
            'master_unit_letter.unit_name',
            'master_classification.classification_name',
            'org.sator_name',
            'suborg.sub_sator_name'
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

        return view('mail.incommingLitnadin.info', compact('data', 'id'));
    }

    public function editLitnadin(Request $request, $id)
    {
        $id = decrypt($id);

        $receiverMails = Dropdown::where('category', 'Penerima Surat Masuk')->get();
        $results = Dropdown::where('category', 'Hasil Penelitian')->get();
        $approveds = Dropdown::where('category', 'Disetujui Oleh')->get();

        // GET MASTER
        $letters = Letter::where('is_active', 1)->get();
        $unitletters = UnitLetter::where('is_active', 1)->get();
        $sators = Sator::orderBy('sator_name', 'asc')->where('is_active', 1)->get();

        $dataEdit = IncommingMail::where('id', $id)->first();
        // Fetch the corresponding additional data
        $lettersData = Letter::where('id', $dataEdit->id_mst_letter)->first();
        $unitlettersData = UnitLetter::where('id', $dataEdit->mail_unit)->first();
        $satorsData = Sator::where('id', $dataEdit->org_unit)->first();
        // Merge the original collections with the additional data if not null, and remove duplicates based on 'id'
        $letters = $lettersData ? $letters->merge([$lettersData])->unique('id') : $letters;
        $unitletters = $unitlettersData ? $unitletters->merge([$unitlettersData])->unique('id') : $unitletters;
        $sators = $satorsData ? $sators->merge([$satorsData])->unique('id') : $sators;

        $data = IncommingMail::select(
            'incomming_mails.*',
            'master_letter.let_name',
            'master_complain.com_name',
            'receiv.work_name as receiver_name',
            'master_unit_letter.unit_name',
            'master_classification.classification_name'
        )
            ->leftjoin('master_letter', 'master_letter.id', 'incomming_mails.id_mst_letter')
            ->leftjoin('master_complain', 'master_complain.id', 'incomming_mails.id_mst_complain')
            ->leftjoin('master_unit_letter', 'master_unit_letter.id', 'incomming_mails.mail_unit')
            ->leftjoin('master_workunit as receiv', 'receiv.id', 'incomming_mails.receiver')
            ->leftjoin('master_classification', 'master_classification.id', 'incomming_mails.archive_classification')
            ->where('incomming_mails.id', $id)
            ->first();

        return view('mail.incommingLitnadin.edit', compact(
            'letters',
            'receiverMails',
            'unitletters',
            'results',
            'approveds',
            'sators',
            'data'
        ));
    }

    public function updateLitnadin(Request $request, $id)
    {
        $id = decrypt($id);

        $request->validate(
            [
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
            ]
        );

        $entry_date = (new DateTime($request->entry_date))->format('Y-m-d H:i:s');
        $mail_date = $request->mail_date ? (new DateTime($request->mail_date))->format('Y-m-d H:i:s') : null;

        // Check With Data Before
        $databefore = IncommingMail::where('id', $id)->first();
        $databefore->result = $request->result;
        $databefore->approved_by = $request->approved_by;
        $databefore->sender = $request->senderInput;
        $databefore->id_mst_letter = $request->id_mst_letter;
        $databefore->org_unit = $request->org_unit;
        $databefore->sub_org_unit = $request->sub_org_unit;
        $databefore->mail_number = $request->mail_number;
        $databefore->mail_regarding = $request->mail_regarding;
        $databefore->entry_date = $entry_date;
        $databefore->mail_date = $mail_date;
        $databefore->receiver = $request->receiver;
        $databefore->mail_quantity = $request->mail_quantity;
        $databefore->mail_unit = $request->mail_unit;
        $databefore->received_via = $request->received_viaInput;
        $databefore->attachment_text = $request->attachment_text;
        $databefore->information = $request->information;
        $databefore->status = $request->status;

        $jmlHal = $request->mail_quantity + ($request->attachment_text ?? 0);
        $redirectParams = [
            'entry_date' => $request->filt_entry_date,
            'mail_date' => $request->filt_mail_date,
            'mail_number' => $request->filt_mail_number,
            'litnadin_number' => $request->filt_litnadin_number,
            'org_unit' => $request->filt_org_unit,
            'letter' => $request->filt_letter,
            'receiver' => $request->filt_receiver,
            'jmlHal' => $request->filt_jmlHal,
            'status' => $request->filt_status,
            'idUpdated' => $id,
        ];

        if ($databefore->isDirty()) {
            DB::beginTransaction();
            try {
                IncommingMail::where('id', $id)->update([
                    'id_mst_letter' => $request->id_mst_letter,
                    'id_mst_complain' => $request->id_mst_complain,
                    'sender' => $request->senderInput,
                    'org_unit' => $request->org_unit,
                    'sub_org_unit' => $request->sub_org_unit,
                    'mail_number' => $request->mail_number,
                    'mail_regarding' => $request->mail_regarding,
                    'entry_date' => $request->entry_date,
                    'mail_date' => $request->mail_date,
                    'receiver' => $request->receiver,
                    'mail_quantity' => $request->mail_quantity,
                    'mail_unit' => $request->mail_unit,
                    'result' => $request->result,
                    'approved_by' => $request->approved_by,
                    'received_via' => $request->received_viaInput,
                    'attachment_text' => $request->attachment_text,
                    'jml_hal' => $jmlHal,
                    'status' => $request->status,
                    'information' => $request->information,
                    'updated_by' => auth()->user()->name,
                ]);

                DB::commit();
                return redirect()->route('incommingmail.indexLitnadin', $redirectParams)->with(['success' => 'Sukses Ubah Data']);
            } catch (Throwable $th) {
                DB::rollback();
                return redirect()->back()->with(['fail' => 'Gagal Ubah Data!']);
            }
        } else {
            return redirect()->route('incommingmail.indexLitnadin', $redirectParams)->with(['info' => 'Tidak ada perubahan, data sama dengan yang sebelumnya']);
        }
    }

    public function createProgressLitnadin(Request $request, $id)
    {
        $id = decrypt($id);

        $request->validate(
            [
                "information" => "required",
                "status" => "required",
            ],
            [
                'information.required' => 'Keterangan Wajib Untuk Diisi.',
                'status.required' => 'Status Wajib Untuk Diisi.',
            ]
        );

        $redirectParams = [
            'entry_date' => $request->filt_entry_date,
            'mail_date' => $request->filt_mail_date,
            'mail_number' => $request->filt_mail_number,
            'litnadin_number' => $request->filt_litnadin_number,
            'org_unit' => $request->filt_org_unit,
            'letter' => $request->filt_letter,
            'receiver' => $request->filt_receiver,
            'jmlHal' => $request->filt_jmlHal,
            'status' => $request->filt_status,
            'idUpdated' => $id,
        ];

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
            return redirect()->route('incommingmail.indexLitnadin', $redirectParams)->with(['success' => 'Sukses Ubah Data']);
        } catch (Throwable $th) {
            DB::rollback();
            return redirect()->route('incommingmail.indexLitnadin', $redirectParams)->with(['fail' => 'Gagal Ubah Data!']);
        }
    }
}
