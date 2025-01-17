<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OutgoingMailsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $datas;

    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    public function collection()
    {
        return $this->datas->map(function($data) {
            return [
                'no' => $data->no,
                'created_at' => \Carbon\Carbon::parse($data->created_at)->format('d-m-Y'),
                'mail_number' => $data->mail_number,
                'receiver' => $this->convertHtmlToPlainText($data->receiver),
                'mail_regarding' => $this->convertHtmlToPlainText($data->mail_regarding),
                'attachment_text' => $this->convertHtmlToPlainText($data->attachment_text),
                'information' => $this->convertHtmlToPlainText($data->archive_remains) . "\n" . $this->convertHtmlToPlainText($data->information),
            ];
        });
    }
    
    private function convertHtmlToPlainText($html)
    {
        // Ganti tag BR dengan newline
        $html = str_replace(['<br>', '<br/>', '<br />'], "\n", $html);
        // Ganti tag P dengan newline
        $html = str_replace(['<p>', '</p>'], "\n", $html);
        // Hapus semua tag HTML lainnya
        $text = strip_tags($html);
        // Decode HTML entities
        $text = html_entity_decode($text);
        // Ganti baris ganda dengan baris tunggal (opsional, tergantung kebutuhan)
        $text = preg_replace("/[\r\n]+/", "\n", $text);
        // Trim spasi berlebihan pada awal dan akhir teks
        $text = trim($text);
        return $text;
    }
    
    
    public function headings(): array
    {
        return [
            'No',
            'Created At',
            'Mail Number',
            'Kepada',
            'Isi/Perihal',
            'Lampiran',
            'Keterangan',
        ];
    }
}
