<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AgendaPejabat;
use App\Models\Pejabat_daerah;
use App\Models\Jabat;
use App\Models\opd;



class AgendaPejabatController extends Controller
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
    public function index(Request $request)
    {

        // pengajuan agenda
        $pejabat=AgendaPejabat::join('pejabat_daerahs','agenda_pejabats.id_pejabat','=','pejabat_daerahs.id')
        ->join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
        ->join('opds','agenda_pejabats.pj','=','opds.id')
        ->select('pejabat_daerahs.nm_pejabat','agenda_pejabats.*',
        'opds.nm_opd','jabats.nm_jabatan')
        ->where('agenda_pejabats.sk',0)
        ->get();
        

        // sudah di proses
        $ag_proses=AgendaPejabat::join('pejabat_daerahs','agenda_pejabats.id_pejabat','=','pejabat_daerahs.id')
        ->join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
        ->join('opds','agenda_pejabats.pj','=','opds.id')      
        ->select('pejabat_daerahs.nm_pejabat','agenda_pejabats.*',
        'opds.nm_opd','jabats.nm_jabatan')
       ->whereIn('agenda_pejabats.sk',[2,1])
       ->get();

     // sudah di tolak
        $ag_tolak=AgendaPejabat::join('pejabat_daerahs','agenda_pejabats.id_pejabat','=','pejabat_daerahs.id')
        ->join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
       ->join('opds','agenda_pejabats.pj','=','opds.id')
       ->select('pejabat_daerahs.nm_pejabat','agenda_pejabats.*',
       'opds.nm_opd','jabats.nm_jabatan')
       ->where('agenda_pejabats.sk','=',3)
       ->get();

    //    dd($ag_tolak);
         return view('admin.kegiatan.pejabat.index',compact('pejabat','ag_proses','ag_tolak'));
    }

    public function cariagenda(Request $request)
    {
        $cari=AgendaPejabat::join('pejabat_daerahs','agenda_pejabats.id_pejabat','=','pejabat_daerahs.id')
        ->join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
        ->join('opds','agenda_pejabats.pj','=','opds.id')      
        ->select('pejabat_daerahs.nm_pejabat','agenda_pejabats.*',
        'opds.nm_opd','jabats.nm_jabatan')
        
        ->whereBetween('agenda_pejabats.tgl',
        [$request->input('tgl_awal'), $request->input('tgl_akhir')])
        ->get();

        return view('admin.kegiatan.pejabat.cari',compact('cari'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pejabat=Pejabat_daerah::join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
        ->select('jabats.nm_jabatan','pejabat_daerahs.*')
        ->where('pejabat_daerahs.id','<>', 0)
        ->get();

        // dd($pejabat);
        $jabatan=Jabat::orderBy('id', 'DESC')->get();
        $opd=opd::orderBy('id', 'DESC')->get();
        return view('admin.kegiatan.pejabat.create',compact('pejabat','jabatan','opd'));
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
             'id_pejabat'        => 'required',
             'pendamping'        => 'required',
             'tempat'            => 'required',
             'nm_kegiatan'       => 'required',
             'map'               => 'required',
             'file_surat'        => 'required|file|mimes:pdf|max:2000',
             'file_acara'        => 'required|file|mimes:pdf|max:2000',
             'file_sambutan'     => 'required|file|mimes:pdf|max:2000',

        ]);
        //upload file_surat
        $file_surat = $request->FILE('file_surat');
        $file_surat->storeAs('public/surat', $file_surat->hashName());

       //upload file_acara
        $file_acara = $request->FILE('file_acara');
        $file_acara->storeAs('public/acara', $file_acara->hashName());

        //upload file_sambutan
        $file_sambutan = $request->FILE('file_sambutan');
        $file_sambutan->storeAs('public/sambutan', $file_sambutan->hashName());
        
        $ap =AgendaPejabat::create([

            'id_pejabat'     => $request->input('id_pejabat'),
            'pj'             => $request->input('pj'),
            'opd'            => $request->input('opd'),
            'nm_kegiatan'    => $request->input('nm_kegiatan'),
            'tempat'         => $request->input('tempat'),
            'tgl'            => $request->input('tgl'),
            'jam_mulai'      => $request->input('jam_mulai'),
            'jam_selsai'     => $request->input('jam_selsai'),
            'sk'             =>0,
            'id_wakil'       =>0,
            'status_t'       =>0,
            'creator'        => $request->input('creator'),
            'map'            => $request->input('map'),
            'file_surat'     => $file_surat->hashName(),
            'file_acara'     => $file_acara->hashName(),
            'file_sambutan'  => $file_sambutan->hashName(),
        ]);
        if($ap){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/agenda-pejabat');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/agenda-pejabat');
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
        $pecah=explode(',',Crypt::decryptString($id));
        // agenda
        $pejabat=AgendaPejabat::where(['id'  =>$pecah[0]])->first();

        // pejabat daerah
        $pd=Pejabat_daerah::join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
        ->select('pejabat_daerahs.nm_pejabat','pejabat_daerahs.id','jabats.nm_jabatan')
        ->orderBy('pejabat_daerahs.id', 'DESC')
        ->get();

        // perangkat daerah
        $pj=opd::orderBy('id', 'DESC')->get();

        $pj2=Pejabat_daerah::orderBy('id', 'DESC')->get();
        
        // join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
        // ->select('pejabat_daerahs.nm_pejabat','pejabat_daerahs.id','jabats.nm_jabatan')
        // ->orderBy('pejabat_daerahs.id', 'DESC')
        // ->get();

        // dd($pj2);

        return view('admin.kegiatan.pejabat.edit',compact('pejabat','pd','pj','pj2'));
    }

    public function edit_file($id)
    {
        $pecah=explode(',',Crypt::decryptString($id));
        $pejabat=AgendaPejabat::where(['id'  =>$pecah[0]])->first();

        return view('admin.kegiatan.pejabat.editfile',compact('pejabat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  AgendaPejabat $agendaPejabat)
    {
        $this->validate($request,[

            'id_pejabat'    => 'required',
            'pj'            => 'required',
            'nm_kegiatan'   => 'required',
            'tempat'        => 'required',
            'tgl'           => 'required',
            'jam_mulai'     => 'required',
            'jam_selsai'    => 'required',
            // 'sk'            => 'required',
            // 'status_t'      => 'required',
        ]);     
           $ag = AgendaPejabat::findOrFail($agendaPejabat->id);
            $ag->update([
                'id_pejabat'    => $request->input('id_pejabat'),
                'pj'            => $request->input('pj'), 
                'nm_kegiatan'   => $request->input('nm_kegiatan'), 
                'tempat'        => $request->input('tempat'), 
                'tgl'           => $request->input('tgl'), 
                'jam_mulai'     => $request->input('jam_mulai'), 
                'jam_selsai'    => $request->input('jam_selsai'), 
                'sk'            => $request->input('sk'), 
                'status_t'      => $request->input('status_t'), 
                'eksekutor'     => $request->input('eksekutor'), 
                'id_wakil'     => $request->input('id_wakil') 
            ]);
        
       
        if($ag){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Update');
            return redirect('/agenda-pejabat');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Gagal Update');
            return redirect('/agenda-pejabat');
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

    public function download_surat(Request $request)
    {
        $files = public_path() . '/storage/surat/' . $request->file; //Mencari file dari model yang sudah dicari
        if (file_exists($files)) {
            return response()->download($files, $request->file);
        } else {
            Alert::error('error','Data Kosong');
            return redirect('/agenda-pejabat');
        }
    }
    public function download_acara(Request $request)
    {
        $files = public_path() . '/storage/acara/' . $request->file; //Mencari file dari model yang sudah dicari
        if (file_exists($files)) {
            return response()->download($files, $request->file);
        } else {
            Alert::error('error','Data Kosong');
            return redirect('/agenda-pejabat');
        }
    }
    public function download_sambutan(Request $request)
    {
        $files = public_path() . '/storage/sambutan/' . $request->file; //Mencari file dari model yang sudah dicari
        if (file_exists($files)) {
            return response()->download($files, $request->file);
        } else {
            Alert::error('error','Data Kosong');
            return redirect('/agenda-pejabat');
        }
    }

    public function update_surat(Request $request, AgendaPejabat $agendaPejabat)
    {
        $this->validate($request,[
            'file_surat'        => 'required|file|mimes:pdf|max:2000',
        ]);

        //remove old image
        Storage::disk('local')->delete('public/surat/'.$agendaPejabat->file_surat);

        //upload new image
        $file_surat = $request->file('file_surat');
        $file_surat->storeAs('public/surat', $file_surat->hashName());

        $st = AgendaPejabat::findOrFail($agendaPejabat->id);
        $st->update([
            'file_surat'     => $file_surat->hashName(), 
        ]);

        if($st){
            //redirect dengan pesan sukses
            Alert::success('success','File Surat Berhasil Terupdate');
           return back();
        }else{
            //redirect dengan pesan error
            Alert::error('error','File Surat Berhasil Terupdate');
           return back();
        }
    
    }

    public function update_acara(Request $request, AgendaPejabat $agendaPejabat)
    {
        $this->validate($request,[
            'file_acara'        => 'required|file|mimes:pdf|max:2000',
        ]);

        //remove old image
        Storage::disk('local')->delete('public/acara/'.$agendaPejabat->file_acara);

        //upload new image
        $file_acara = $request->file('file_acara');
        $file_acara->storeAs('public/acara', $file_acara->hashName());

        $st = AgendaPejabat::findOrFail($agendaPejabat->id);
        $st->update([
            'file_acara'     => $file_acara->hashName(), 
        ]);

        if($st){
            //redirect dengan pesan sukses
            Alert::success('success','File Acara Berhasil Terupdate');
           return back();
        }else{
            //redirect dengan pesan error
            Alert::error('error','File Acara Berhasil Terupdate');
           return back();
        }
    
    }

    public function update_sambutan(Request $request, AgendaPejabat $agendaPejabat)
    {
        $this->validate($request,[
            'file_sambutan'        => 'required|file|mimes:pdf|max:2000',
        ]);

        //remove old image
        Storage::disk('local')->delete('public/sambutan/'.$agendaPejabat->file_sambutan);

        //upload new image
        $file_sambutan = $request->file('file_sambutan');
        $file_sambutan->storeAs('public/sambutan', $file_sambutan->hashName());

        $st = AgendaPejabat::findOrFail($agendaPejabat->id);
        $st->update([
            'file_sambutan'     => $file_sambutan->hashName(), 
        ]);

        if($st){
            //redirect dengan pesan sukses
            Alert::success('success','File Sambutan Berhasil Terupdate');
           return back();
        }else{
            //redirect dengan pesan error
            Alert::error('error','File Sambutan Berhasil Terupdate');
           return back();
        }
    
    }

}
