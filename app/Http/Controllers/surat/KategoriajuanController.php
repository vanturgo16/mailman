<?php

namespace App\Http\Controllers\surat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori_ajuan;

class KategoriajuanController extends Controller
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
        $kategori= Kategori_ajuan::get();
        return view('admin.kategoriajuan.index',compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategoriajuan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'keterangan'      => 'required',   
            'status'          => 'required'   
        ]);
        $kategori = Kategori_ajuan::create([
            'keterangan'      => $request->input('keterangan'),
            'status'          => $request->input('status'),
            'email'           => $request->input('email')
        ]);
       
        if($kategori){
            return redirect('/kategori')->with('status','Data Berhasil Ditambah');}
            else{
                return redirect('/kategori')->with('error','Gagal Ditambah');
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
        $kategori=Kategori_ajuan::where('id', $id)->first();
        return view('admin.kategoriajuan.edit',compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori_ajuan $kategori_ajuan)
    {
        $this->validate($request,[
            'keterangan'    => 'required',
            'status'        => 'required'
           
        ]);

            $kategori = Kategori_ajuan::findOrFail($kategori_ajuan->id);
            $kategori->update([

                'keterangan'   => $request->input('keterangan'),
                'status'       => $request->input('status')
            
            ]);

        if($kategori){
            //redirect dengan pesan sukses
            return redirect('/kategori')->with(['success' => 'update successfully!']);
        }else{
            //redirect dengan pesan error
            return redirect('/kategori')->with(['error' => 'unsuccessfully!']);
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
        Kategori_ajuan::find($id)->delete(); 
       return back()->with(['success' => ' successfully!']);
    }
}
