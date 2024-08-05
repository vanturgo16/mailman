<?php

namespace App\Console\Commands;

use App\Models\Complain;
use App\Models\IncommingMail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

// Model
use App\Models\Letter;
use App\Models\LastNumberingIncomming;
use App\Models\LastNumberingIncommingLitnadin;
use App\Models\QueNumbIncMail;
use App\Traits\GenerateNumber;

use Illuminate\Console\Command;

class GenerateAgendaNumber extends Command
{
    protected $signature = 'GenerateAgendaNumber';
    protected $description = 'Generate Agenda of Email';
    use GenerateNumber;

    public function handle()
    {
        $today = Carbon::today();

        $queincomming = QueNumbIncMail::select('que_numb_incomming_mail.*','incomming_mails.id_mst_complain', 'incomming_mails.placeman', 'incomming_mails.created_at as created_mail')
            ->leftjoin('incomming_mails', 'que_numb_incomming_mail.id_mail', 'incomming_mails.id')
            ->get();

        DB::beginTransaction();
        try {
            //No Agenda Surat Masuk
            foreach($queincomming as $queinc){
                if($queinc->placeman == "PENGADUAN"){
                    //LastNumb
                    $lastnumber = LastNumberingIncomming::where('id_mst_complain', $queinc->id_mst_complain)->first();
                    $number = $lastnumber ? $lastnumber->last_number : 0;
                    $number++;
                    //Code
                    $code = Complain::where('id', $queinc->id_mst_complain)->first()->com_code;
                    //CreatedDate
                    $date = $queinc->created_mail;
                    $dateTime = new DateTime($date);
                    $monthRoman = $dateTime->format('m');
                    $romanMonths = [
                        '01' => 'I', '02' => 'II', '03' => 'III', '04' => 'IV',
                        '05' => 'V', '06' => 'VI', '07' => 'VII', '08' => 'VIII',
                        '09' => 'IX', '10' => 'X', '11' => 'XI', '12' => 'XII'
                    ];
                    $monthRoman = $romanMonths[$monthRoman];
                    $year = $dateTime->format('Y');

                    $agenda_number = "R/$code.$number/$monthRoman/$year/Setum";
                    //Update Agenda Number
                    IncommingMail::where('id', $queinc->id_mail)->update(["agenda_number" => $agenda_number]);
                    //Update Last Number
                    $lastnumber = LastNumberingIncomming::where('id_mst_complain', $queinc->id_mst_complain)->first();
                    if($lastnumber){
                        LastNumberingIncomming::where('id_mst_complain', $queinc->id_mst_complain)->update(["last_number" => $number]);
                    } else {
                        LastNumberingIncomming::create([
                            'id_mst_complain' => $queinc->id_mst_complain,
                            'last_number' => $number,
                        ]);
                    }
                    //Delete Que
                    QueNumbIncMail::where('id_mail', $queinc->id_mail)->delete();
                } else {
                    //LastNumb
                    if($queinc->placeman == "LITNADIN"){
                        $lastnumber = LastNumberingIncommingLitnadin::where('id_mst_letter', $queinc->id_mst_letter)->first();
                    } else {
                        $lastnumber = LastNumberingIncomming::where('id_mst_letter', $queinc->id_mst_letter)->first();
                    }
                    $number = $lastnumber ? $lastnumber->last_number : 0;
                    $number++;
                    //Code
                    $code = Letter::where('id', $queinc->id_mst_letter)->first()->let_code;
                    //CreatedDate
                    $date = $queinc->created_mail;
                    $dateTime = new DateTime($date);
                    $monthRoman = $dateTime->format('m');
                    $romanMonths = [
                        '01' => 'I', '02' => 'II', '03' => 'III', '04' => 'IV',
                        '05' => 'V', '06' => 'VI', '07' => 'VII', '08' => 'VIII',
                        '09' => 'IX', '10' => 'X', '11' => 'XI', '12' => 'XII'
                    ];
                    $monthRoman = $romanMonths[$monthRoman];
                    $year = $dateTime->format('Y');

                    $agenda_number = "$code/$number/$monthRoman/$year/Setum";
                    //Update Agenda Number
                    IncommingMail::where('id', $queinc->id_mail)->update(["agenda_number" => $agenda_number]);
                    //Update Last Number
                    if($queinc->placeman == "LITNADIN"){
                        $lastnumber = LastNumberingIncommingLitnadin::where('id_mst_letter', $queinc->id_mst_letter)->first();
                    } else {
                        $lastnumber = LastNumberingIncomming::where('id_mst_letter', $queinc->id_mst_letter)->first();
                    }
                    if($lastnumber){
                        if($queinc->placeman == "LITNADIN"){
                            LastNumberingIncommingLitnadin::where('id_mst_letter', $queinc->id_mst_letter)->update(["last_number" => $number]);
                        } else {
                            LastNumberingIncomming::where('id_mst_letter', $queinc->id_mst_letter)->update(["last_number" => $number]);
                        }
                    } else {
                        if($queinc->placeman == "LITNADIN"){
                            LastNumberingIncommingLitnadin::create([
                                'id_mst_letter' => $queinc->id_mst_letter,
                                'last_number' => $number,
                            ]);
                        } else {
                            LastNumberingIncomming::create([
                                'id_mst_letter' => $queinc->id_mst_letter,
                                'last_number' => $number,
                            ]);
                        }
                    }
                    //Delete Que
                    QueNumbIncMail::where('id_mail', $queinc->id_mail)->delete();
                }
            }

            DB::commit();
            
            echo ('Success Running Command at '.$today);
        } catch (Throwable $th) {
            DB::rollback();
            echo ('Failed Run Command at '.$today.' error: '.$th);
        }
    }
}
