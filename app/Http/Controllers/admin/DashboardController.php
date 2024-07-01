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
    public function index()
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
        
        // dd($datas_in); // Dump and die to inspect the data
        

        return view('admin.dashboard',compact('datas','datas_in'));
    }

   
  
}
