<?php

namespace App\Http\Controllers\admin;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\opd;
use App\Models\Jenis;


class OpdController extends Controller
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
        $opd=opd::join('jenis','jenis.id','=','opds.jenis')
        ->select('opds.*','jenis.nm_jenis as nm_j')
        ->get();
         return view('admin.master.opd.index',compact('opd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis=Jenis::orderBy('id', 'DESC')->get();
        return view('admin.master.opd.create',compact('jenis'));
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
            'nm_opd'        => 'required',
            'jenis'         => 'required',
            'singkatan'     => 'required',
           
       ]);
       $opd =opd::create([

           'nm_opd'        => $request->input('nm_opd'),
           'jenis'         => $request->input('jenis'),
           'singkatan'     => $request->input('singkatan'),
           'operator'      => $request->input('operator')
       ]);
       if($opd){
           //redirect dengan pesan sukses
           Alert::success('success','Berhasil Di Simpan');
           return redirect('/opd');
       }else{
           //redirect dengan pesan error
           Alert::error('error','Berhasil Di Simpan');
           return redirect('/opd');
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
        $jenis=Jenis::orderBy('id', 'ASC')->get();
        $staff = opd::where('id', $id)->first();
        return view('admin.master.opd.edit', compact('staff','jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, opd $opd)
    {
        $this->validate($request,[

            'nm_opd'        => 'required',
            'jenis'         => 'required',
            'singkatan'     => 'required',
        ]);

            $opd = opd::findOrFail($opd->id);
            $opd->update([
                'nm_opd'        => $request->input('nm_opd'),
                'jenis'         => $request->input('jenis'),
                'singkatan'     => $request->input('singkatan'),
                'operator'      => $request->input('operator') 
            ]);

        if($opd){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Update');
            return redirect('/opd');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Update');
            return redirect('/opd');
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
        $jml= opd::findOrFail($id);
        $jml->delete();
        if($jml){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Hapus');
            return back();
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Hapus');
            return back();
        }
    }
}
