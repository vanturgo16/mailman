<?php

namespace App\Http\Controllers;

use App\Models\DaftarGedung;
use Illuminate\Http\Request;

class DaftarGedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gedungs = DaftarGedung::get();
    
        return view('gedung.index',compact('gedungs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('hai ini store gedung');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DaftarGedung  $daftarGedung
     * @return \Illuminate\Http\Response
     */
    public function show(DaftarGedung $daftarGedung)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DaftarGedung  $daftarGedung
     * @return \Illuminate\Http\Response
     */
    public function edit(DaftarGedung $daftarGedung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DaftarGedung  $daftarGedung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DaftarGedung $daftarGedung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DaftarGedung  $daftarGedung
     * @return \Illuminate\Http\Response
     */
    public function destroy(DaftarGedung $daftarGedung)
    {
        //
    }
}
