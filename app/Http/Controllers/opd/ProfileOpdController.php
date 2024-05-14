<?php

namespace App\Http\Controllers\opd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\AgendaPejabat;
use App\Models\User;


class ProfileOpdController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth'); 
    //     // $this->middleware(['permission:permissions.index']);
    // }
    public function index()
    {
        $profile=DB::table('users')
        ->join('opds','users.id_opd','=','opds.id')
        ->select('opds.nm_opd')
        ->where('users.id',Auth::user()->id)
        ->first();

        $agenda =agendaPejabat::where('creator', Auth::user()->email)
        ->where([
               'tgl' => date('Y-m-d')
        ])->get();
        
        return view('opd.dashboard',compact('profile','agenda'));
    }

    public function edit_profil()
    {
        $profil=User::where('id', Auth::user()->id)->first();
        return view('opd.profile',compact('profil'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|',
            'email'     => 'required|email|unique:users,email,'.Auth::user()->id 
        ]);
        
        $user = User::where('id',Auth::user()->id );

        if($request->input('password') == "") {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email')
            ]);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password'))
            ]);
        }

        if($user){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Update');
            return redirect('/profil');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Update');
            return redirect('/profil');
        }
    }
    public function update_image(Request $request)
    {
        $this->validate($request, [
            'profile_photo_path'        => 'required|image|mimes:png,jpg,jepg|max:2000',
        ]);
        //remove old image
        Storage::disk('local')->delete('public/staff/'.Auth::user()->profile_photo_path);

        //upload new image
        $profile_photo_path = $request->file('profile_photo_path');
        $profile_photo_path->storeAs('public/staff', $profile_photo_path->hashName());

        $user = User::where('id',Auth::user()->id );
            $user->update([
                'profile_photo_path'      => $profile_photo_path->hashName(),
               
            ]);

        if($user){
            //redirect dengan pesan sukses
            Alert::success('success','Berhasil Di Update');
            return redirect('/profil');
        }else{
            //redirect dengan pesan error
            Alert::error('error','Berhasil Di Update');
            return redirect('/profil');
        }
    }
}
