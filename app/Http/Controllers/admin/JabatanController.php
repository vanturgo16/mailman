<?php

namespace App\Http\Controllers\admin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jabat;

class JabatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pejabat=Jabat::get();
         return view('admin.master.jabatan.index',compact('pejabat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
             'nm_jabatan'        => 'required',
             'operator'          => 'required'
        ]);
        $jabatan =Jabat::create([

            'nm_jabatan'     => $request->input('nm_jabatan'),
            'operator'       => $request->input('operator')
        ]);
        if($jabatan){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/jabatan');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/jabatan');
        }
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
        $staff = Jabat::where('id', $id)->first();
        return view('admin.master.jabatan.edit', compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabat $jabat)
    {
        $this->validate($request,[

            'nm_jabatan'     => 'required',
            'operator'       => 'required',
        ]);

            $pejabat = Jabat::findOrFail($jabat->id);
            $pejabat->update([
                'nm_jabatan' => $request->input('nm_jabatan'),
                'operator'   => $request->input('operator'), 
            ]);

        if($pejabat){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Update');
            return redirect('/jabatan');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Update');
            return redirect('/jabatan');
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
