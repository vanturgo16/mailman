<?php

namespace App\Http\Controllers\admin;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pejabat_daerah;
use App\Models\Jabat;


class PejabatController extends Controller
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
       $pejabat=Pejabat_daerah::join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
       ->select('jabats.nm_jabatan','pejabat_daerahs.*')
       ->get();
        return view('admin.master.pejabat.index',compact('pejabat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jabatan=Jabat::orderBy('id', 'ASC')->get();
        return view('admin.master.pejabat.create',compact('jabatan'));

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
            // 'image'             => 'required|image|mimes:jpeg,jpg,png|max:2000',
            // 'nm_pejabat'        => 'required',
            // 'id_jabatan'        => 'required',
            // 'operator'          => 'required',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/staff', $image->hashName());

        $pejabat =Pejabat_daerah::create([
            'image'          => $image->hashName(),
            'nm_pejabat'     => $request->input('nm_pejabat'),
            'id_jabatan'     => $request->input('id_jabatan'),
            'email'          => $request->input('email'),
            'operator'       => $request->input('operator'), 

        ]);

        if($pejabat){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/pejabat');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/pejabat');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ag=Jabat::get();
        $staff = Pejabat_daerah::where('id', $id)->first();
        return view('admin.master.pejabat.edit', compact('staff','ag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Pejabat_daerah $pejabat_daerah)
    {
        $this->validate($request,[
            'nm_pejabat'     => 'required',
            'email'          => 'required|unique:staff,nip,'.$pejabat_daerah->id,
            'id_jabatan'     => 'required',
            'operator'       => 'required',
        ]);

        if ($request->file('image') == "") {
        
            $pejabat = Pejabat_daerah::findOrFail($pejabat_daerah->id);
            $pejabat->update([
                'nm_pejabat' => $request->input('nm_pejabat'),
                'id_jabatan' => $request->input('id_jabatan'),
                'email'      => $request->input('email'),
                'operator'   => $request->input('operator'), 
            ]);

        } else {

            //remove old image
            Storage::disk('local')->delete('public/staff/'.$pejabat_daerah->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/staff', $image->hashName());

            $pejabat = Pejabat_daerah::findOrFail($pejabat_daerah->id);
            $pejabat->update([
                'image'     => $image->hashName(),
                'nm_pejabat' => $request->input('nm_pejabat'),
                'id_jabatan' => $request->input('id_jabatan'),
                'email'      => $request->input('email'),
                'operator'   => $request->input('operator'), 
            ]);

        }

        if($pejabat){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Update');
            return redirect('/pejabat');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Update');
            return redirect('/pejabat');
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
        $jml= Pejabat_daerah::findOrFail($id);
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

