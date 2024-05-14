<?php

namespace App\Http\Controllers\profil;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profildesa;

class ProfildesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil_desa=Profildesa::first();
        return view('admin.frontmenu.profil.index',compact('profil_desa'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profildesa $profildesa)
    {
        $this->validate($request,[
          
            'nm_desa'         => 'required',
            'alamat'          => 'required',
            'tlpn'            => 'required',
            'email'           => 'required',
            'kecamatan'       => 'required',
            'kota_kab'        => 'required',
            'provinsi'        => 'required',
            'kd_pos'          => 'required',

        ]);

        $profil_desa = Profildesa::first();
        $profil_desa->update([

            'nm_desa'         => $request->input('nm_desa'),
            'alamat'          => $request->input('alamat'),
            'tlpn'            => $request->input('tlpn'),
            'email'           => $request->input('email'),
            'fb'              => $request->input('fb'),
            'tw'              => $request->input('tw'),
            'ig'              => $request->input('ig'),
            'youtube'         => $request->input('youtube'),
            'created'         => Auth::user()->name,
            'kecamatan'       => $request->input('kecamatan'),
            'kota_kab'        => $request->input('kota_kab'),
            'provinsi'        => $request->input('provinsi'),
            'kd_pos'          => $request->input('kd_pos'),
           
        ]);

        if($profil_desa){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Update');
            return back();

        }else{
            //redirect dengan pesan error
            Alert::error('error','Gagal Di Update');
            return back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
