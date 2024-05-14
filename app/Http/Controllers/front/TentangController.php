<?php

namespace App\Http\Controllers\front;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\sambutan;
use App\Models\sejarah;
use App\Models\visimisi;
use App\Models\Potensi_alam;

class TentangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    }

    public function index()
    {
        $visi = Visimisi::first();
        $sejarah = Sejarah::first();
        $sambutan= Sambutan::first();
        $potensi= Potensi_alam::first();
        return view('admin.frontmenu.tentang.index',compact('visi','sejarah','sambutan','potensi'));
    }

    public function edit_sambutan($id)
    {
        $sambutan = Sambutan::first();
        //dd($sambutan);
        return view('admin.frontmenu.tentang.sambutan',compact('sambutan'));
    }

    public function edit_visimisi($id)
    {
        $visimisi = Visimisi::first();
        return view('admin.frontmenu.tentang.visimisi',compact('visimisi'));
    }

    public function edit_sejarah($id)
    {
        $sejarah = Sejarah::first();
        return view('admin.frontmenu.tentang.sejarah',compact('sejarah'));
    }

    public function edit_Potensi_alam($id)
    {
        $potensi = Potensi_alam::first();
        return view('admin.frontmenu.tentang.potensi',compact('potensi'));
    }

    public function update_sambutan(Request $request, Sambutan $sambutan)
    {
        $this->validate($request,[
            'nm_kep'   => 'required',
            'des'      => 'required'
        ]);

        if ($request->file('foto') == "") {
        
            $sambutan = Sambutan::findOrFail($sambutan->id);
            $sambutan->update([
                'email'         => Auth::user()->name,
                'nm_kep'        => $request->input('nm_kep'),
                'des'           => $request->input('des'),
                'des1'           => $request->input('des1')
            ]);

        } else {

            //remove old foto
            Storage::disk('local')->delete('public/staff/'.$sambutan->foto);

            //upload new foto
            $foto = $request->file('foto');
            $foto->storeAs('public/staff', $foto->hashName());

            $sambutan = Sambutan::findOrFail($sambutan->id);
            $sambutan->update([
                'foto'          => $foto->hashName(),
                'email'         => Auth::user()->name,
                'nm_kep'        => $request->input('nm_kep'),
                'des'           => $request->input('des'),
                'des1'           => $request->input('des1')
            ]);

        }

        if($sambutan){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/about-desa');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/about-desa');
        }
    }

    public function update_visimisi(Request $request, Visimisi $visimisi)
    {
        $this->validate($request,[
            'visi'   => 'required',
            'misi'   => 'required'
        ]);

            $visimisi = Visimisi::findOrFail($visimisi->id);
            $visimisi->update([

                'visi'        => $request->input('visi'),
                'misi'        => $request->input('misi'),
                'email'       => Auth::user()->name
            ]);

        

        if($visimisi){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/about-desa');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/about-desa');
        }
    }
    public function update_sejarah(Request $request, Sejarah $sejarah)
    {
        $this->validate($request,[
            'des'   => 'required'
            
        ]);

            $sejarah = Sejarah::findOrFail($sejarah->id);
            $sejarah->update([

                'des'        => $request->input('des'),
                'email'    => Auth::user()->name
            ]);

        if($sejarah){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/about-desa');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/about-desa');
        }
    }

    public function update_potensi_alam(Request $request, Potensi_alam $potensi)
    {

        $this->validate($request,[
            'des'               => 'required',
            'batas_utara'       => 'required',
            'batas_timur'       => 'required',
            'batas_selatan'     => 'required',
            'batas_barat'       => 'required',
        ]);

        if ($request->file('image') == "") {
        
            $potensi = Potensi_alam::findOrFail($potensi->id);
            $potensi->update([
                
                'des'                   => $request->input('des'),
                'des1'                  => $request->input('des1'),
                'batas_utara'           => $request->input('batas_utara'),
                'batas_timur'           => $request->input('batas_timur'),
                'batas_selatan'         => $request->input('batas_selatan'),
                'batas_barat'           => $request->input('batas_barat'),
                'operator'              => Auth::user()->name,
            ]);

        } else {

            //remove old image
            Storage::disk('local')->delete('public/staff/'.$potensi->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/staff', $image->hashName());

            $potensi = Potensi_alam::findOrFail($potensi->id);
            $potensi->update([
                'image'                 => $image->hashName(),
                'des'                   => $request->input('des'),
                'des1'                  => $request->input('des1'),
                'batas_utara'           => $request->input('batas_utara'),
                'batas_timur'           => $request->input('batas_timur'),
                'batas_selatan'         => $request->input('batas_selatan'),
                'batas_barat'           => $request->input('batas_barat'),
                'operator'              => Auth::user()->name,
            ]);

        }

        if($potensi){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/about-desa');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/about-desa');
        }
    }

}
