<?php

namespace App\Http\Controllers\front;

use App\Models\Posts;
use App\Models\Staff;
use App\Models\Video;
use App\Models\Juknis;
use App\Models\Slider;
use App\Models\Gallery;
use App\Models\sejarah;
use App\Models\sambutan;
use App\Models\visimisi;
use App\Models\PesanWarga;
use App\Models\Profildesa;
use App\Models\Potensi_alam;
use Illuminate\Http\Request;
use App\Models\AgendaPejabat;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class FrondandController extends Controller
{
  public function __construct()
  {
    // parent::__construct();
    $this->profil_desa = Profildesa::first();
    $this->posts = Posts::latest()->paginate(8);
  }

  public function login()
  {
    return redirect('/login');
  }

  public function index()
  {
    $profil_desa = Profildesa::first();
    $visi = Visimisi::first();
    $sejarah = Sejarah::first();
    $sambutan = Sambutan::first();
    $potensi = Potensi_alam::first();
    $staff = Staff::get();
    $post = Posts::paginate(12);
    $posts = Posts::latest()->paginate(8);
    $slider = Slider::paginate(5);
    // dd($posts);
    return view('welcome', compact(
      'profil_desa',
      'visi',
      'sejarah',
      'sambutan',
      'staff',
      'post',
      'potensi',
      'slider',
      'posts'
    ));
  }

  public function surat_online()
  {
    $profil_desa = Profildesa::first();
    return view('sk_online.dashboard', compact('profil_desa'));
  }

  public function berita()
  {
    $profil_desa = Profildesa::first();
    $posts = Posts::orderBy('id', 'DESC')->paginate(9);

    // $post= Posts::paginate(10);
    return view('frontand.berita', compact('posts', 'profil_desa'));
  }

  public function berita_show($id, $slug)
  {
    $profil_desa = $this->profil_desa;
    $post_all = Posts::orderBy('id', 'DESC')->limit(10);
    // $post = Posts::where('id', $id)->first();
    // return view('frontand.berita_show', compact('post', 'post_all', 'profil_desa'));
    // get the current user
    $post = Posts::find($id);
    // get previous user id
    $previous = Posts::where('id', '<', $post->id)->max('id');
    // get next user id
    $next = Posts::where('id', '>', $post->id)->min('id');
    $post_previous = Posts::where('id', $previous)->first();
    $post_next = Posts::where('id', $next)->first();
    // dd($post_next);
    return view('frontand.berita_show', compact('post', 'post_all', 'profil_desa', 'post_previous', 'post_next'))->with('previous', $previous)->with('next', $next);
  }

  public function sambutan_show($id)
  {
    $profil_desa = Profildesa::first();
    $sambutan = sambutan::where('id', $id)->first();
    return view('frontand.sambutan_show', compact('sambutan', 'profil_desa'));
  }

  public function potensi_show($id)
  {
    $sambutan = sambutan::where('id', $id)->first();
    $profil_desa = Profildesa::first();
    $potensi = Potensi_alam::where('id', $id)->first();
    return view('frontand.potensi_show', compact('potensi', 'profil_desa', 'sambutan'));
  }

  public function gallery()
  {
    $profil_desa = Profildesa::first();
    $gallery = Gallery::orderBy('id', 'DESC')->paginate(6);
    return view('frontand.gallery', compact('gallery', 'profil_desa'));
  
  }
  public function galleryVideo()
  {
    $profil_desa = Profildesa::first();
    $videos = Video::orderBy('id', 'DESC')->paginate(6);
    return view('frontand.galleryVideo', compact('videos', 'profil_desa'));
  }

  public function juknis()
  {
    $profil_desa = Profildesa::first();
    $juknis = Juknis::orderBy('id', 'DESC')->paginate(5);
    return view('frontand.juknis', compact('juknis', 'profil_desa'));
  }

  public function kontak()
  {
    $profil_desa = Profildesa::first();
    return view('frontand.kontak', compact('profil_desa'));
  }

  public function profile()
  {
    $profil_desa = Profildesa::first();
    $visi = Visimisi::first();
    $sejarah = Sejarah::first();
    $sambutan = Sambutan::first();
    return view('frontand.profile', compact('profil_desa', 'sambutan', 'visi', 'sejarah'));
  }
  public function agenda()
  {
    $tgl = date('Y-m-d');
    $profil_desa = Profildesa::first();
    $agenda = AgendaPejabat::where('status_t', 1)->get();
    $agenda_hari_ini = AgendaPejabat::where('tgl', $tgl)->get();
    $pejabat = AgendaPejabat::join('pejabat_daerahs', 'agenda_pejabats.id_pejabat', '=', 'pejabat_daerahs.id')
      ->join('jabats', 'pejabat_daerahs.id_jabatan', '=', 'jabats.id')
      ->join('opds', 'agenda_pejabats.pj', '=', 'opds.id')
      ->select(
        'pejabat_daerahs.nm_pejabat',
        'agenda_pejabats.*',
        'opds.nm_opd',
        'jabats.nm_jabatan'
      )
      ->where('agenda_pejabats.status_t', 1)
      ->paginate(10);
    $pejabat_hari_ini = AgendaPejabat::join('pejabat_daerahs', 'agenda_pejabats.id_pejabat', '=', 'pejabat_daerahs.id')
      ->join('jabats', 'pejabat_daerahs.id_jabatan', '=', 'jabats.id')
      ->join('opds', 'agenda_pejabats.pj', '=', 'opds.id')
      ->select(
        'pejabat_daerahs.nm_pejabat',
        'agenda_pejabats.*',
        'opds.nm_opd',
        'jabats.nm_jabatan'
      )
      ->where('agenda_pejabats.tgl', $tgl)
      ->get();
    return view('frontand.agenda', compact('profil_desa', 'agenda', 'agenda_hari_ini', 'pejabat', 'pejabat_hari_ini'));
  }

  public function store_kontak(Request $request)
  {

    $this->validate($request, [
      'nama'        => 'required|max:30',
      'email'       => 'required',
      'subjek'      => 'required|max:100',
      'pesan'       => 'required',
    ]);

    $pesan = PesanWarga::create([
      'nama'      => $request->input('nama'),
      'email'     => $request->input('email'),
      'subjek'    => $request->input('subjek'),
      'pesan'     => $request->input('pesan'),
    ]);

    if ($pesan) {
      //redirect dengan pesan sukses
      Alert::success('success', 'Pesan Anda Berhasil Di Kirim');
      return redirect('/surat-online');
    } else {
      //redirect dengan pesan error
      Alert::error('error', 'Pesan Anda Gagal Di Kirim');
      return redirect('/surat-online');
    }
  }
}
