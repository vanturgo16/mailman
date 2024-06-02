<?php

namespace App\Http\Controllers;

use App\Models\DaftarLantai;
use App\Models\DaftarRuang;
use Illuminate\Http\Request;

class MappingLokasiSimpanController extends Controller
{
    public function getLantai($gedungId)
    {
        $lantais = DaftarLantai::where('id_gedung', $gedungId)->get();
        return response()->json($lantais);
    }

    public function getRuang($lantaiId)
    {
        $ruangs = DaftarRuang::where('id_lantai', $lantaiId)->get();
        return response()->json($ruangs);
    }
}
