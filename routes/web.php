<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\profil\ProfildesaController;
use App\Http\Controllers\front\FrondandController;
use App\Http\Controllers\front\GalleryController;
use App\Http\Controllers\front\TentangController;
use App\Http\Controllers\front\PostsController;
use App\Http\Controllers\front\EventController;

use App\Http\Controllers\opd\ProfileOpdController;
use App\Http\Controllers\opd\BenneropdController;
use App\Http\Controllers\opd\AjuanAgenda;


use App\Http\Controllers\front\SliderController;
use Carbon\Carbon;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     if (request()->start_date || request()->end_date) {
//         $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
//         $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
//         $data = User::whereBetween('created_at',[$start_date,$end_date])->get();

//     } else {
//         $data = User::latest()->get();
//     }
    

//     return view('cari', compact('data'));
// });

    Route::controller(FrondandController::class)->group(function () {
        Route::get('/', 'login')->name('login');
        // Route::get('/', 'index')->name('welcome');
        // Route::get('/berita-desa', 'berita');
        // Route::get('/berita', 'berita');
        // Route::get('/berita/{id}/{slug}', 'berita_show');
        // Route::get('/berita-desa/{id}/show', 'berita_show');
        // Route::get('/galeri', 'gallery');
        // Route::get('/galeriVideo', 'galleryVideo');
        // Route::get('/juknis', 'juknis');
        // Route::get('/kontak', 'kontak');
        // Route::get('/profile', 'profile');
        // Route::get('/agenda', 'agenda');
        // Route::post('/kontak-desa', 'store_kontak');
    });

Route::group(['middleware' => 'cekadmin'], function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/pesan/{id}/show', 'show_pesan');
        Route::get('/data-pesan', 'index_pesan');
        Route::get('/pesan-trash', 'index_trash');
        Route::delete('/data-pesan/{id}/destroy', 'pesan_destroy');
        Route::post('/pesan-trash/{id}/restore', 'pesan_restore');
        Route::delete('/pesan-trash/{id}/delete-permanent', 'deletePermanent');
    });

    // juknis
    Route::controller(JuknisController::class)->group(function () {
        Route::get('/data-juknis', 'index');
        Route::get('/data-juknis/create', 'create');
        Route::post('/data-juknis', 'store');
        Route::delete('/data-juknis/{id}/destroy', 'destroy');
      });

    //pejabat

    Route::controller(PejabatController::class)->group(function () {
        Route::get('/pejabat', 'index');
        Route::get('/create-pejabat', 'create');
        Route::post('/pejabat', 'store');
        Route::get('/pejabat/edit/{id}', 'edit');
        Route::patch('/pejabat/update/{pejabat_daerah}', 'update');
        Route::delete('/pejabat/{id}/destroy', 'destroy');
    
    });

    // jabatan
    Route::controller(JabatanController::class)->group(function () {
        Route::get('/jabatan', 'index');
        Route::get('/create-jabatan', 'create');
        Route::post('/jabatan', 'store');
        Route::get('/jabatan/edit/{id}', 'edit');
        Route::patch('/jabatan/update/{jabat}', 'update');
   
    });

    //opd
    Route::controller(OpdController::class)->group(function () {
        Route::get('/opd', 'index');
        Route::get('/create-opd', 'create');
        Route::post('/opd', 'store');
        Route::get('/opd/edit/{id}', 'edit');
        Route::patch('/opd/update/{opd}', 'update');
        Route::delete('/opd/{id}/destroy', 'destroy');   
    });
    // agenda pejabat
    Route::controller(AgendaPejabatController::class)->group(function () {
        Route::get('/agenda-pejabat', 'index');
        Route::post('/cari-agenda', 'cariagenda');
        Route::get('/create-agenda-pejabat', 'create');
        Route::post('/agenda-pejabat', 'store');
        Route::get('/agenda-pejabat/edit/{id}', 'edit');
        Route::get('/edit/file/{id}', 'edit_file');
        Route::patch('/agenda-pejabat/update/{agendaPejabat}', 'update');

        Route::patch('/update/surat/{agendaPejabat}', 'update_surat');
        Route::patch('/update/acara/{agendaPejabat}', 'update_acara');
        Route::patch('/update/sambutan/{agendaPejabat}', 'update_sambutan');

        Route::delete('/agenda-pejabat/{id}/destroy', 'destroy');  
        Route::post('/download-file-surat', 'download_surat');  
        Route::post('/download-file-acara', 'download_acara');  
        Route::post('/download-file-sambutan', 'download_sambutan');  

    });
    // arsip
    Route::controller(ArsipController::class)->group(function () {
        Route::get('/cari-arsip', 'index');
        Route::get('/cari-arsip/cari','index_cari');
    
    });

    // Permission
    Route::controller(PermissionController::class)->group(function () {
        Route::get('/permission', 'index');
        Route::get('/permission/create', 'create');
        Route::post('/permission', 'store');
    
    });
    //user
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
        Route::get('/user/create', 'create');
        Route::post('/user', 'store');
        Route::get('/user/edit/{user}', 'edit');
        Route::patch('/user/update/{user}', 'update');
        Route::delete('/hapus-user/{user}', 'destroy');
    
    });
    // role
    Route::controller(RoleController::class)->group(function () {
        Route::get('/role', 'index');
        Route::get('/role/create', 'create');
        Route::post('/role', 'store');
        Route::get('/role/edit/{role}', 'edit');
        Route::patch('/role/update/{role}', 'update');
    }); 

    // frontmenu profil desa
    Route::controller(ProfilController::class)->group(function () {
        Route::get('/profil', 'index');
        Route::patch('/profil/update', 'update');
        Route::patch('/foto-profil/update', 'update_image');
    });

    // frontmenu profil desa
    Route::controller(ProfildesaController::class)->group(function () {
        Route::get('/profil-app', 'index');
        Route::patch('/profildesa/update', 'update');
    });
    // frontmenu Berita
    Route::controller(PostsController::class)->group(function () {
        Route::get('/data-berita', 'index');
        Route::get('/data-berita/create', 'create');
        Route::post('/data-berita', 'store');
        Route::get('/data-berita/show/{id}', 'show');
        Route::get('/data-berita/edit/{id}', 'edit');
        Route::patch('/data-berita/update/{posts}', 'update');
        Route::delete('/berita/{id}/destroy', 'destroy');
    });

    // frontmenu Event
    Route::controller(EventController::class)->group(function () {
        Route::get('/data-event', 'index');
        Route::get('/data-event/create', 'create');
        Route::post('/data-event', 'store');
        Route::get('/data-event/show/{id}', 'show');
        Route::get('/data-event/edit/{id}', 'edit');
        Route::patch('/data-event/update/{event}', 'update');
        Route::delete('/event/{id}/destroy', 'destroy');

    });

    // frontmenu Gallery
    Route::controller(GalleryController::class)->group(function () {
        Route::get('/data-gallery', 'index');
        Route::get('/data-gallery/create', 'create');
        Route::post('/data-gallery', 'store');
        Route::delete('/data-gallery/{id}/destroy', 'destroy');
        Route::delete('/data-gallery/{id}/destroy_video', 'destroy_v');
    });

// frontmenu Gallery
    Route::controller(TentangController::class)->group(function () {
        Route::get('/about-profil', 'index');
        Route::get('/about-profil/edit/{id}', 'edit_sambutan');
        Route::get('/about-profil/edit_visimisi/{id}', 'edit_visimisi');
        Route::get('/about-profil/edit_sejarah/{id}', 'edit_sejarah');
        Route::get('/about-profil/edit-potensi/{id}', 'edit_potensi_alam');

        Route::patch('/about-profil/update/{sambutan}', 'update_sambutan');
        Route::patch('/about-profil/update_sejarah/{sejarah}', 'update_sejarah');
        Route::patch('/about-profil/update_visimisi/{visimisi}', 'update_visimisi');
        Route::patch('/about-profil/update-potensi/{potensi}', 'update_potensi_alam');
    });

    // frontmenu staff
    Route::controller(StaffController::class)->group(function () {
        Route::get('/data-staff', 'index');
        Route::get('/data-staff/create', 'create');
        Route::post('/data-staff', 'store');
        Route::get('/data-staff/show/{id}', 'show');
        Route::get('/data-staff/edit/{id}', 'edit');
        Route::patch('/data-staff/update/{staff}', 'update');
        Route::delete('/data-staff/{id}/destroy', 'destroy');

    });
    // frontmenu jml penduduk
    Route::controller(JmlpendudukController::class)->group(function () {
        Route::get('/data-jml-penduduk', 'index');
        Route::get('/data-jml-penduduk/create', 'create');
        Route::post('/data-jml-penduduk', 'store');
        Route::delete('/data-jml-penduduk/{id}/destroy', 'destroy');

    });
    Route::controller(SliderController::class)->group(function () {
        Route::get('/user/profile', 'index');
        Route::get('/data-slider/create', 'create');
        Route::post('/data-slider', 'store');
        Route::delete('/data-slider/{id}/delete-permanent', 'deletePermanent');
    });
    // benner
    Route::controller(BenneradmController::class)->group(function () {
        Route::get('/adm-benner', 'index');
        Route::get('/create-adm-benner', 'create');
        Route::post('/adm-benner', 'store');
        Route::get('/adm-benner/edit/{id}', 'edit');
        Route::delete('/adm-benner/{id}/destroy', 'destroy');
       
    });
});

Route::group(['middleware' => 'cekopd'], function () {
    
    Route::controller(ProfileOpdController::class)->group(function () {
        Route::get('/user/profile', 'index')->middleware(['auth', 'verified'])->name('useropd');
        Route::get('/profile/edit', 'edit_profil');
        Route::patch('/profile/update', 'update');
        Route::patch('/foto-profile/update', 'update_image');
       
    });

    // ajuan agenda dari opd
    Route::controller(AjuanAgenda::class)->group(function () {
        Route::get('/ajuan-agenda', 'index');
        Route::get('/create-ajuan-agenda', 'create');
        Route::post('/ajuan-agenda', 'store');
        Route::get('/ajuan-agenda/edit/{id}', 'edit');
        Route::post('/download-opd-surat', 'download_surat_opd');  
        Route::post('/download-opd-acara', 'download_acara_opd');  
        Route::post('/download-opd-sambutan', 'download_sambutan_opd'); 
       
    });
    Route::controller(BenneropdController::class)->group(function () {
        Route::get('/ajuan-benner', 'index');
        Route::get('/create-ajuan-benner', 'create');
        Route::post('/ajuan-benner', 'store');
        Route::get('/ajuan-benner/edit/{id}', 'edit');
        Route::delete('/ajuan-benner/{id}/destroy', 'destroy');
       
    });
});
    
require __DIR__.'/auth.php';