<?php

namespace App\Http\Controllers\opd;

use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pejabat_daerah;
use App\Models\AgendaPejabat;
use Illuminate\Http\Request;
use App\Models\Jabat;
use App\Models\opd;

class AjuanAgenda extends Controller
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
         // pengajuan agenda
         $pejabat=AgendaPejabat::join('pejabat_daerahs','agenda_pejabats.id_pejabat','=','pejabat_daerahs.id')
         ->join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
         ->join('opds','agenda_pejabats.pj','=','opds.id')
         ->select('pejabat_daerahs.nm_pejabat','agenda_pejabats.*',
         'opds.nm_opd','jabats.nm_jabatan')
         ->where('agenda_pejabats.sk',0)
         ->where('agenda_pejabats.creator',Auth::user()->email)
         ->get();
 
         // sudah di proses
         $ag_proses=AgendaPejabat::join('pejabat_daerahs','agenda_pejabats.id_pejabat','=','pejabat_daerahs.id')
         ->join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
        ->join('opds','agenda_pejabats.pj','=','opds.id')
        ->select('pejabat_daerahs.nm_pejabat','agenda_pejabats.*',
        'opds.nm_opd','jabats.nm_jabatan')
        ->whereIn('agenda_pejabats.sk',[2,1])
        ->where('agenda_pejabats.creator',Auth::user()->email)
        ->get();
 
      // sudah di tolak
         $ag_tolak=AgendaPejabat::join('pejabat_daerahs','agenda_pejabats.id_pejabat','=','pejabat_daerahs.id')
         ->join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
        ->join('opds','agenda_pejabats.pj','=','opds.id')
        ->select('pejabat_daerahs.nm_pejabat','agenda_pejabats.*',
        'opds.nm_opd','jabats.nm_jabatan')
        ->where('agenda_pejabats.sk','=',3)
        ->where('agenda_pejabats.creator',Auth::user()->email)
        ->get();
 
     //    dd($ag_tolak);
          return view('opd.agenda.index',compact('pejabat','ag_proses','ag_tolak'));
 
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
        ->get();

        $opd=DB::table('users')
        ->join('opds','users.id_opd','=','opds.id')
        ->select('opds.nm_opd','opds.id')
        ->where('users.id',Auth::user()->id)
        ->first();

        $jabatan=Jabat::orderBy('id', 'DESC')->get();

        return view('opd.agenda.create',compact('pejabat','jabatan','opd'));
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
        //    'pendamping'     => $request->input('pendamping'),
           'pj'             => $request->input('pj'),
           'opd'            => $request->input('opd'),
           'nm_kegiatan'    => $request->input('nm_kegiatan'),
           'tempat'         => $request->input('tempat'),
           'tgl'            => $request->input('tgl'),
           'jam_mulai'      => $request->input('jam_mulai'),
           'jam_selsai'     => $request->input('jam_selsai'),
           'sk'             =>0,
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
           return redirect('/ajuan-agenda');
       }else{
           //redirect dengan pesan error
           Alert::error('error','Berhasil Di Simpan');
           return redirect('/ajuan-agenda');
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
        // agenda
        $pejabat=AgendaPejabat::where('id', $id)->first();
       
        // pejabat daerah
        $pd=Pejabat_daerah::join('jabats','pejabat_daerahs.id_jabatan','=','jabats.id')
        ->select('pejabat_daerahs.nm_pejabat','pejabat_daerahs.id','jabats.nm_jabatan')
        ->orderBy('pejabat_daerahs.id', 'DESC')
        ->get();

        $opd=DB::table('users')
        ->join('opds','users.id_opd','=','opds.id')
        ->select('opds.nm_opd','opds.id')
        ->where('users.id',Auth::user()->id)
        ->first();
       
        return view('opd.agenda.edit',compact('pejabat','pd','opd'));
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

            // 'id_pejabat'    => 'required',
            // 'pendamping'    => 'required',
            // 'pj'            => 'required',
            // 'nm_kegiatan'   => 'required',
            // 'tempat'        => 'required',
            // 'tgl'           => 'required',
            // 'jam_mulai'     => 'required',
            // 'jam_selsai'    => 'required',
            // 'sk'            => 'required',
            // 'status_t'      => 'required',
        ]);

        if($request->file('file_surat')==""){

            $ag = AgendaPejabat::findOrFail($agendaPejabat->id);
            $ag->update([
                'id_pejabat'    => $request->input('id_pejabat'),
                'pj'            => $request->input('pj'), 
                'nm_kegiatan'   => $request->input('nm_kegiatan'), 
                'tempat'        => $request->input('tempat'), 
                'tgl'           => $request->input('tgl'), 
                'jam_mulai'     => $request->input('jam_mulai'), 
                'jam_selsai'    => $request->input('jam_selsai'), 
                'creator'       => $request->input('creator'),
                'map'            => $request->input('map'),
            ]);

        }else{
            //remove old image
           Storage::disk('local')->delete('public/surat/'.$agendaPejabat->file_surat);
           
           // upload file
           $file_surat = $request->file('file_surat');
           $file_surat->storeAs('public/surat', $file_surat->hashName());

           $ag = AgendaPejabat::findOrFail($agendaPejabat->id);
           $ag->update([
            'id_pejabat'    => $request->input('id_pejabat'),
            'pj'            => $request->input('pj'), 
            'nm_kegiatan'   => $request->input('nm_kegiatan'), 
            'tempat'        => $request->input('tempat'), 
            'tgl'           => $request->input('tgl'), 
            'jam_mulai'     => $request->input('jam_mulai'), 
            'jam_selsai'    => $request->input('jam_selsai'), 
            'creator'       => $request->input('creator'),
            'map'           => $request->input('map'),
            'file_surat'    => $file_surat->hashName(),

           ]);

       }

        if($ag){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Update');
            return redirect('/agenda-pejabat');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Update');
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
    public function download_surat_opd(Request $request)
    {
        $files = public_path() . '/storage/surat/' . $request->file; //Mencari file dari model yang sudah dicari
        if (file_exists($files)) {
            return response()->download($files, $request->file);
        } else {
            Alert::error('error','Data Kosong');
            return redirect('/agenda-pejabat');
        }
    }
    public function download_acara_opd(Request $request)
    {
        $files = public_path() . '/storage/acara/' . $request->file; //Mencari file dari model yang sudah dicari
        if (file_exists($files)) {
            return response()->download($files, $request->file);
        } else {
            Alert::error('error','Data Kosong');
            return redirect('/agenda-pejabat');
        }
    }
    public function download_sambutan_opd(Request $request)
    {
        $files = public_path() . '/storage/sambutan/' . $request->file; //Mencari file dari model yang sudah dicari
        if (file_exists($files)) {
            return response()->download($files, $request->file);
        } else {
            Alert::error('error','Data Kosong');
            return redirect('/agenda-pejabat');
        }
    }
}
