<?php

namespace App\Http\Controllers\admin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
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
        // belum
        $datas = OutgoingMail::select('outgoing_mails.*', 'outgoing_mails.updated_at as last_update', 'outgoing_mails.created_at as created',
        'draft.work_name as drafter_name', 'master_letter.let_name')
        ->leftJoin('master_workunit as draft', 'draft.id', '=', 'outgoing_mails.drafter')
        ->leftJoin('master_letter', 'master_letter.id', '=', 'outgoing_mails.id_mst_letter')
        ->whereDate('outgoing_mails.updated_at', Carbon::today()->toDateString()) // Only compare the date part
        ->orderBy('created_at', 'desc')
        ->get();


        $datas_in = IncommingMail::select('incomming_mails.*', 'receiv.work_name as receiver_name',
                    'incomming_mails.updated_at as last_update', 'incomming_mails.created_at as created')
                    ->leftJoin('master_workunit as receiv', 'receiv.id', '=', 'incomming_mails.receiver')
                    ->whereDate('incomming_mails.updated_at', Carbon::today()->toDateString())
                    ->orderBy('created_at', 'desc')
                    ->get(); // Execute the query
        
        // grafik st masuk
$incomingMails = IncommingMail::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', Carbon::now()->year)
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();

    $monthlyIncomingMails = array_fill(1, 12, 0);
    foreach ($incomingMails as $month => $count) {
        $monthlyIncomingMails[$month] = $count;
    }

        // grafik st masuk
        $outgoingMails = OutgoingMail::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('month')
        ->pluck('count', 'month')
        ->toArray();

    $monthlyOutgoingMails = array_fill(1, 12, 0);
    foreach ($outgoingMails as $month => $count) {
    $monthlyOutgoingMails[$month] = $count;
    }
        

        return view('admin.dashboard',compact('datas','datas_in','monthlyIncomingMails','monthlyOutgoingMails'));
    }

   
  
}
