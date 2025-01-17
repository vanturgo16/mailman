<?php

namespace App\Http\Controllers\admin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\OutgoingMail;
use App\Models\IncommingMail;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    } 


    public function index(Request $request)
    {
        // Mengambil data surat keluar hari ini
        $datas = OutgoingMail::select('outgoing_mails.*', 'outgoing_mails.updated_at as last_update', 'outgoing_mails.created_at as created',
            'draft.work_name as drafter_name', 'master_letter.let_name')
            ->leftJoin('master_workunit as draft', 'draft.id', '=', 'outgoing_mails.drafter')
            ->leftJoin('master_letter', 'master_letter.id', '=', 'outgoing_mails.id_mst_letter')
            ->whereDate('outgoing_mails.updated_at', Carbon::today()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Mengambil data surat masuk hari ini
        $datas_in = IncommingMail::select('incomming_mails.*', 'receiv.work_name as receiver_name',
            'incomming_mails.updated_at as last_update', 'incomming_mails.created_at as created')
            ->leftJoin('master_workunit as receiv', 'receiv.id', '=', 'incomming_mails.receiver')
            ->whereDate('incomming_mails.updated_at', Carbon::today()->toDateString())
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Grafik surat masuk
        $incomingMails = IncommingMail::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
    
        $monthlyIncomingMails = array_fill(1, 12, 0);
        foreach ($incomingMails as $month => $count) {
            $monthlyIncomingMails[$month] = $count;
        }
    
        // Grafik surat keluar
        $outgoingMails = OutgoingMail::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
    
        $monthlyOutgoingMails = array_fill(1, 12, 0);
        foreach ($outgoingMails as $month => $count) {
            $monthlyOutgoingMails[$month] = $count;
        }

        $mails = DB::table('outgoing_mails')
                    ->join('master_letter', 'outgoing_mails.id_mst_letter', '=', 'master_letter.id')
                    ->select('master_letter.let_name', DB::raw('count(outgoing_mails.id_mst_letter) as total'))
                    ->groupBy('master_letter.let_name')
                    ->get();

        // Mendefinisikan array warna
        $colors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
        ];

        // Memastikan ada cukup warna untuk tiap let_name
        $colorData = [];
        foreach ($mails as $index => $mail) {
            $colorData[] = $colors[$index % count($colors)];
        }
    
        return view('admin.dashboard', compact('datas', 'datas_in', 'monthlyIncomingMails', 'monthlyOutgoingMails','mails','colorData'));
    }
    

   
  
}
