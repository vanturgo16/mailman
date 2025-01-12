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
use App\Models\LastNumberingOutgoing;
use App\Models\QueNumbIncMail;
use App\Models\WorkUnit;
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

        $que = QueNumbOutMail::select('que_numb_outgoing_mail.*', 'outgoing_mails.org_unit', 'outgoing_mails.signing', 'outgoing_mails.kka_code', 'outgoing_mails.created_at as created_mail', 'master_pattern.pat_simple', 'master_pattern.pat_mix', 'master_pattern.pat_type')
            ->leftjoin('outgoing_mails', 'que_numb_outgoing_mail.id_mail', 'outgoing_mails.id')
            ->leftjoin('master_pattern', 'que_numb_outgoing_mail.id_mst_letter', 'master_pattern.let_id')
            ->get();

        DB::beginTransaction();
        try {
            $error = false;
            foreach($que as $q){
                if($q->pat_type == "Sederhana")
                {
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
                    if($lastnumber){
                        LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->update(["last_number" => $number]);
                    } else {
                        LastNumberingOutgoing::create([
                            'id_mst_letter' => $q->id_mst_letter,
                            'last_number' => $number,
                        ]);
                    }
                    //Delete Que
                    QueNumbOutMail::where('id_mail', $q->id_mail)->delete();
                } 
                elseif ($q->pat_type == "Perpaduan")
                {
                    $lastnumber = LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->first();
                    $number = $lastnumber ? $lastnumber->last_number : 0;
                    $number++;
    
                    $pattern = $q->pat_mix;
                    $patterns = json_decode($pattern, true);
    
                    $mail_number = [];
    
                    foreach($patterns as $pat){
                        if($pat == "Naskah Dinas"){
                            // $value = strtoupper(Letter::where('id', $q->id_mst_letter)->first()->let_code);
                            $value = Letter::where('id', $q->id_mst_letter)->first()->let_code;
                            $mail_number[] = $value;
                        } elseif($pat == "Kode Klasifikasi Arsip (KKA)") {
                            $value = $q->kka_code;
                            $mail_number[] = $value;
                        }  elseif($pat == "Unit Kerja") {
                            // Exclude Add Unit Kerja IF Penandatanganan Kapolri/Wakapolri With This Jenis Surat List
                            $exclude = false;
                            // Mail Type
                            $listMail = ['Surat Biasa', 'Surat Rahasia', 
                                        'Surat Pengantar Biasa',
                                        'Surat Pengantar Rahasia', 'Surat Pengantar Biasa (BARU)',
                                        'Surat Undangan', 'Telaahan Staf'
                                    ];
                            $mailType = Letter::where('id', $q->id_mst_letter)->first();
                            $mailType = $mailType ? $mailType->let_name : null;
                            if(in_array($mailType, $listMail)){ 
                                // Signer
                                $listSigner = ['Kapolri', 'Wakapolri'];
                                $signer = WorkUnit::where('id', $q->signing)->first();
                                $signer = $signer ? $signer->work_name : null;
                                if(in_array($signer, $listSigner)){ $exclude = true; }
                            }

                            if($exclude){ 
                                $mail_number[] = null; 
                            } else {
                                $value = Sator::where('id', $q->org_unit)->first()->sator_name;
                                $mail_number[] = $value;
                            }
                        } elseif($pat == "Sifat Surat") {
                            $value = "Null";
                            $mail_number[] = $value;
                        } elseif($pat == "Nomor Urut") {
                            $value = $number;
                            $mail_number[] = $value;
                            // Update Last Number
                            $lastnumber = LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->first();
                            if($lastnumber){
                                LastNumberingOutgoing::where('id_mst_letter', $q->id_mst_letter)->update(["last_number" => $number]);
                            } else {
                                LastNumberingOutgoing::create([
                                    'id_mst_letter' => $q->id_mst_letter,
                                    'last_number' => $number,
                                ]);
                            }
                        } elseif($pat == "Bulan Terbit") {
                            $timestamp = strtotime($q->created_mail);
                            $value = date('m', $timestamp);
                            $romanMonths = [
                                '01' => 'I', '02' => 'II', '03' => 'III', '04' => 'IV',
                                '05' => 'V', '06' => 'VI', '07' => 'VII', '08' => 'VIII',
                                '09' => 'IX', '10' => 'X', '11' => 'XI', '12' => 'XII'
                            ];
                            $value = $romanMonths[$value];
                            $mail_number[] = $value;
                        } elseif($pat == "Tahun Terbit") {
                            $timestamp = strtotime($q->created_mail);
                            $value = date('Y', $timestamp);
                            $mail_number[] = $value;
                        // Pattern Symbol
                        } else {
                            // $value = "Null";
                            $mail_number[] = $pat;
                        }
                    }
                    // Filter out null values
                    $mail_number = array_filter($mail_number, function($value) {
                        return $value !== null;
                    });
                    // $mail_number = implode('/', $mail_number);
                    $mail_number = implode('', $mail_number);
                    // Ensure no trailing slash remains
                    $mail_number = rtrim($mail_number, '/');
    
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

            DB::commit();
            
            echo ('Success Running Command at '.$today);
        } catch (Throwable $th) {
            DB::rollback();
            echo ('Failed Run Command at '.$today.' error: '.$th);
        }
    }
}
