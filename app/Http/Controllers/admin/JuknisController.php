<?php

namespace App\Http\Controllers\admin;

use App\Models\Juknis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;

class JuknisController extends Controller
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
    $juknis = Juknis::orderBy('created_at', 'DESC')->get();
    return view('admin.frontmenu.juknis.index', compact('juknis'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.frontmenu.juknis.create');
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
      'nm_file'         => 'required|mimes:pdf|max:2000',
      'operator'      => 'required',
    ]);

    //upload File
    $nm_file = $request->FILE('nm_file');
    $nm_file->storeAs('public/juknis', $nm_file->hashName());

    $juknis = Juknis::create([
      'nm_file'       => $nm_file->hashName(),
      'judul_file'       => $request->input('judul_file'),
      'operator'    => $request->input('operator'),

    ]);

    if ($juknis) {
      //redirect dengan pesan sukses
      Alert::success('success', 'Berhasil Di Simpan');
      return redirect('/data-juknis');
    } else {
      //redirect dengan pesan error
      Alert::error('error', 'Berhasil Di Simpan');
      return redirect('/data-juknis');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Juknis  $juknis
   * @return \Illuminate\Http\Response
   */
  public function show(Juknis $juknis)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Juknis  $juknis
   * @return \Illuminate\Http\Response
   */
  public function edit(Juknis $juknis)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Juknis  $juknis
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Juknis $juknis)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Juknis  $juknis
   * @return \Illuminate\Http\Response
   */
  public function destroy($juknis)
  {
    $juknis = Juknis::findOrFail($juknis);
    if (Storage::exists('public/juknis/' . $juknis->nm_file)) {
      Storage::delete('public/juknis/' . $juknis->nm_file);
      $juknis->delete();
      Alert::success('success', 'Berhasil Di Hapus');
      return back();
    } else {
      Alert::error('error', 'Berhasil Di Hapus');
      return back();
    }
  }
}
