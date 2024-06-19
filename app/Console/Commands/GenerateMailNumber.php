<?php

namespace App\Console\Commands;

use App\Models\Complain;
use App\Models\IncommingMail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateTime;

// Model
use App\Models\Letter;
use App\Models\OutgoingMail;
use App\Models\QueNumbOutMail;
use App\Models\Sator;
use App\Models\LastNumbering;
use App\Models\QueNumbIncMail;
use App\Traits\GenerateNumber;

use Illuminate\Console\Command;

class GenerateMailNumber extends Command
{
    protected $signature = 'GenerateMailNumber';
    protected $description = 'Generate Number of Email';
    use GenerateNumber;

    public function handle()
    {
        $today = Carbon::today();

        $que = QueNumbOutMail::select('que_numb_outgoing_mail.*', 'outgoing_mails.org_unit', 'outgoing_mails.mail_date', 'master_pattern.pat_simple', 'master_pattern.pat_mix', 'master_pattern.pat_type')
            ->leftjoin('outgoing_mails', 'que_numb_outgoing_mail.id_mail', 'outgoing_mails.id')
            ->leftjoin('master_pattern', 'que_numb_outgoing_mail.id_mst_letter', 'master_pattern.let_id')
            ->get();

        $queincomming = QueNumbIncMail::select('que_numb_incomming_mail.*','incomming_mails.id_mst_complain', 'incomming_mails.placeman', 'incomming_mails.mail_date', 'master_pattern.pat_simple', 'master_pattern.pat_mix', 'master_pattern.pat_type')
            ->leftjoin('incomming_mails', 'que_numb_incomming_mail.id_mail', 'incomming_mails.id')
            ->leftjoin('master_pattern', 'que_numb_incomming_mail.id_mst_letter', 'master_pattern.let_id')
            ->get();

        DB::beginTransaction();
        try {
            $error = false;
            foreach($que as $q){
                if($q->pat_type == "Sederhana")
                {
                    $lastnumber = LastNumbering::where('id_mst_letter', $q->id_mst_letter)->first();
                    $number = $lastnumber ? $lastnumber->last_number : 0;
                    $pattern = $q->pat_simple;
                    $number++;
                    $mail_number_with = $this->generateNumbering($pattern, $number);
                    $mail_number = $this->generateNumberingWithout($pattern, $number);
    
                    //Update Mail Number
                    OutgoingMail::where('id', $q->id_mail)->update(["mail_number" => $mail_number, "mail_number_with" => $mail_number_with]);
                    //Update Last Number
                    $lastnumber = LastNumbering::where('id_mst_letter', $q->id_mst_letter)->first();
                    if($lastnumber){
                        LastNumbering::where('id_mst_letter', $q->id_mst_letter)->update(["last_number" => $number]);
                    } else {
                        LastNumbering::create([
                            'id_mst_letter' => $q->id_mst_letter,
                            'last_number' => $number,
                        ]);
                    }
                    //Delete Que
                    QueNumbOutMail::where('id_mail', $q->id_mail)->delete();
                } 
                elseif ($q->pat_type == "Perpaduan")
                {
                    $lastnumber = LastNumbering::where('id_mst_letter', $q->id_mst_letter)->first();
                    $number = $lastnumber ? $lastnumber->last_number : 0;
                    $number++;
    
                    $pattern = $q->pat_mix;
                    $patterns = json_decode($pattern, true);
    
                    $mail_number = [];
    
                    foreach($patterns as $pat){
                        if($pat == "Naskah Dinas"){
                            $value = strtoupper(Letter::where('id', $q->id_mst_letter)->first()->let_code);
                            $mail_number[] = $value;
                        } elseif($pat == "Unit Kerja") {
                            $value = Sator::where('id', $q->org_unit)->first()->sator_name;
                            $mail_number[] = $value;
                        } elseif($pat == "Sifat Surat") {
                            $value = "Null";
                            $mail_number[] = $value;
                        } elseif($pat == "Nomor Urut") {
                            $value = $number;
                            $mail_number[] = $value;
                            // Update Last Number
                            $lastnumber = LastNumbering::where('id_mst_letter', $q->id_mst_letter)->first();
                            if($lastnumber){
                                LastNumbering::where('id_mst_letter', $q->id_mst_letter)->update(["last_number" => $number]);
                            } else {
                                LastNumbering::create([
                                    'id_mst_letter' => $q->id_mst_letter,
                                    'last_number' => $number,
                                ]);
                            }
                        } elseif($pat == "Bulan Terbit") {
                            $timestamp = strtotime($q->mail_date);
                            $value = date('m', $timestamp);
                            $mail_number[] = $value;
                        } elseif($pat == "Tahun Terbit") {
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
                } 
                elseif ($q->pat_type == "Tidak Ada Nomor")
                {
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

            //No Agenda Surat Masuk
            foreach($queincomming as $queinc){
                if($queinc->placeman == "PENGADUAN"){
                    $lastnumber = LastNumbering::where('id_mst_complain', $queinc->id_mst_complain)->first();
                    $number = $lastnumber ? $lastnumber->last_number : 0;
                    $number++;
                    $code = Complain::where('id', $queinc->id_mst_complain)->first()->com_code;
                    $date = $queinc->mail_date;
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
                    $lastnumber = LastNumbering::where('id_mst_complain', $queinc->id_mst_complain)->first();
                    if($lastnumber){
                        LastNumbering::where('id_mst_complain', $queinc->id_mst_complain)->update(["last_number" => $number]);
                    } else {
                        LastNumbering::create([
                            'id_mst_letter' => 0,
                            'id_mst_complain' => $queinc->id_mst_complain,
                            'last_number' => $number,
                        ]);
                    }
                    //Delete Que
                    QueNumbIncMail::where('id_mail', $queinc->id_mail)->delete();
                } else {
                    if($queinc->pat_type == "Sederhana")
                    {
                        $lastnumber = LastNumbering::where('id_mst_letter', $queinc->id_mst_letter)->first();
                        $number = $lastnumber ? $lastnumber->last_number : 0;
                        $pattern = $queinc->pat_simple;
                        $number++;
                        $agenda_number_with = $this->generateNumbering($pattern, $number);
                        $agenda_number = $this->generateNumberingWithout($pattern, $number);
        
                        //Update Agenda Number
                        IncommingMail::where('id', $queinc->id_mail)->update(["agenda_number" => $agenda_number, "agenda_number_with" => $agenda_number_with]);
                        //Update Last Number
                        $lastnumber = LastNumbering::where('id_mst_letter', $queinc->id_mst_letter)->first();
                        if($lastnumber){
                            LastNumbering::where('id_mst_letter', $queinc->id_mst_letter)->update(["last_number" => $number]);
                        } else {
                            LastNumbering::create([
                                'id_mst_letter' => $queinc->id_mst_letter,
                                'last_number' => $number,
                            ]);
                        }
                        //Delete Que
                        QueNumbIncMail::where('id_mail', $queinc->id_mail)->delete();
                    } 
                    elseif ($queinc->pat_type == "Perpaduan")
                    {
                        $lastnumber = LastNumbering::where('id_mst_letter', $queinc->id_mst_letter)->first();
                        $number = $lastnumber ? $lastnumber->last_number : 0;
                        $number++;
        
                        $pattern = $queinc->pat_mix;
                        $patterns = json_decode($pattern, true);
        
                        $agenda_number = [];
        
                        foreach($patterns as $pat){
                            if($pat == "Naskah Dinas"){
                                $value = strtoupper(Letter::where('id', $queinc->id_mst_letter)->first()->let_code);
                                $agenda_number[] = $value;
                            } elseif($pat == "Unit Kerja") {
                                $value = "Null";
                                $agenda_number[] = $value;
                            } elseif($pat == "Sifat Surat") {
                                $value = "Null";
                                $agenda_number[] = $value;
                            } elseif($pat == "Nomor Urut") {
                                $value = $number;
                                $agenda_number[] = $value;
                                // Update Last Number
                                $lastnumber = LastNumbering::where('id_mst_letter', $queinc->id_mst_letter)->first();
                                if($lastnumber){
                                    LastNumbering::where('id_mst_letter', $queinc->id_mst_letter)->update(["last_number" => $number]);
                                } else {
                                    LastNumbering::create([
                                        'id_mst_letter' => $queinc->id_mst_letter,
                                        'last_number' => $number,
                                    ]);
                                }
                            } elseif($pat == "Bulan Terbit") {
                                $timestamp = strtotime($queinc->mail_date);
                                $value = date('m', $timestamp);
                                $agenda_number[] = $value;
                            } elseif($pat == "Tahun Terbit") {
                                $timestamp = strtotime($queinc->mail_date);
                                $value = date('Y', $timestamp);
                                $agenda_number[] = $value;
                            } else {
                                $value = "Null";
                                $agenda_number[] = $value;
                            }
                        }
                        $agenda_number = implode('/', $agenda_number);
        
                        //Update Agenda Number
                        IncommingMail::where('id', $queinc->id_mail)->update(["agenda_number" => $agenda_number]);
                        //Delete Que
                        QueNumbIncMail::where('id_mail', $queinc->id_mail)->delete();
                    } 
                    elseif ($queinc->pat_type == "Tidak Ada Nomor")
                    {
                        $agenda_number = "Tidak Ada Nomor";
        
                        //Update Agenda Number
                        IncommingMail::where('id', $queinc->id_mail)->update(["agenda_number" => $agenda_number]);
                        //Delete Que
                        QueNumbIncMail::where('id_mail', $queinc->id_mail)->delete();
                    } else {
                        $error = true;
                        //Update Que
                        QueNumbIncMail::where('id_mail', $queinc->id_mail)->update(["status" => 1]);
                    }
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
