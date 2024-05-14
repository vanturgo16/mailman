<?php

namespace App\Http\Controllers\opd;

use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Benner;

class BenneropdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        // $this->middleware(['permission:permissions.index']);
    }

    public function index()
    {
        $bener=Benner::where('creator', Auth::user()->email)->get();
        return view('opd.bener.index',compact('bener'));
    }

    public function create()
    {
        return view('opd.bener.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'title'         => 'required|unique:posts',
           
        ]);

        //upload image
        $image = $request->FILE('image');
        $image->storeAs('public/benner', $image->hashName());

        $berita = Benner::CREATE([
            'image'       => $image->hashName(),
            'title'       => $request->input('title'),
            'des'         => $request->input('des'),
            'creator'     => Auth::user()->email,
            'status'      => 0
           

        ]);

        if($berita){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Simpan');
            return redirect('/ajuan-benner');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Simpan');
            return redirect('/ajuan-benner');
        }

    }
    public function destroy($id)
    {
        $benner= Benner::findOrFail($id);
        $benner->delete();
        
        return back();
    }

}
