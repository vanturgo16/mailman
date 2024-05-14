<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Jml_penduduk;

class JmlpendudukController extends Controller
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
        $jml= Jml_penduduk::get();
        return view('admin.master.penduduk.index',compact('jml'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.penduduk.create');
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
           
            'jml_laki'           => 'required',
            'jml_perempuan'      => 'required',
            'th'                 => 'required|unique:jml_penduduks,th',
          
        ]);
        $jml =Jml_penduduk::create([
            'jml_laki'          => $request->input('jml_laki'),
            'jml_perempuan'     => $request->input('jml_perempuan'),
            'th'                => $request->input('th'),
            'operator'          => Auth::user()->name, 

        ]);

        if($jml){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/data-jml-penduduk');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/data-jml-penduduk');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jml= Jml_penduduk::findOrFail($id);
        $jml->delete();
        if($jml){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return back();
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return back();
        }
        
    }
}
