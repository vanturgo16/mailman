<?php

namespace App\Http\Controllers;

// Model
use App\Models\DaftarBaris;
use App\Models\DaftarBox;
use App\Models\DaftarKolom;
use App\Models\DaftarLantai;
use App\Models\DaftarRak;
use App\Models\DaftarRuang;

class SaveLocationMapController extends Controller
{
    public function listLantai($id)
    {
        $listLantai = DaftarLantai::where('id_gedung', $id)->get();
        return $listLantai;
    }
    public function listRuang($id)
    {
        $listRuang = DaftarRuang::where('id_lantai', $id)->get();
        return $listRuang;
    }
    public function listRak($id)
    {
        $listRak = DaftarRak::where('id_ruang', $id)->get();
        return $listRak;
    }
    public function listBaris($id)
    {
        $listBaris = DaftarBaris::where('id_rak', $id)->get();
        return $listBaris;
    }
    public function listKolom($id)
    {
        $listKolom = DaftarKolom::where('id_baris', $id)->get();
        return $listKolom;
    }
    public function listBoks($id)
    {
        $listBox = DaftarBox::where('id_kolom', $id)->get();
        return $listBox;
    }
}
