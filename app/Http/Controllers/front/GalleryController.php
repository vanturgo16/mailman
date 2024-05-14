<?php

namespace App\Http\Controllers\front;

use App\Models\Video;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class GalleryController extends Controller
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
    $gallery = Gallery::get();
    $video = Video::get();
    return view('admin.frontmenu.gallery.index', compact('gallery', 'video'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.frontmenu.gallery.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if ($request->image) {
      $this->validate($request, [
        'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',
        'operator'      => 'required',
      ]);

      //upload image
      $image = $request->FILE('image');
      $image->storeAs('public/gallery', $image->hashName());

      $gallery = Gallery::create([
        'image'       => $image->hashName(),
        'operator'    => $request->input('operator'),

      ]);
    }

    if ($request->video) {
      $this->validate($request, [
        'video'         => 'required',
        'keterangan'    => 'required',
        'operator'      => 'required',
      ]);

      //upload image
      // $image = $request->FILE('image');
      // $image->storeAs('public/gallery', $image->hashName());

      $gallery = Video::create([
        'video'    => $request->input('video'),
        'keterangan'    => $request->input('keterangan'),
        'operator'    => $request->input('operator'),
      ]);
    }


    if ($gallery) {
      //redirect dengan pesan sukses
      Alert::success('success', 'Berhasil Di Simpan');
      return redirect('/data-gallery');
    } else {
      //redirect dengan pesan error
      Alert::error('error', 'Berhasil Di Simpan');
      return redirect('/data-gallery');
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
    $gallery = Gallery::findOrFail($id);
    $gallery->delete();

    if ($gallery) {
      //redirect dengan pesan sukses
      Alert::success('success', 'Berhasil Di Hapus');
      return back();
    } else {
      //redirect dengan pesan error
      Alert::error('error', 'Berhasil Di Hapus');
      return back();
    }
  }
  public function destroy_v($id)
  {
    $video = Video::findOrFail($id);
    $video->delete();

    if ($video) {
      //redirect dengan pesan sukses
      Alert::success('success', 'Berhasil Di Hapus');
      return back();
    } else {
      //redirect dengan pesan error
      Alert::error('error', 'Berhasil Di Hapus');
      return back();
    }
  }
}
