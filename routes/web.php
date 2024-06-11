<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\DaftarBarisController;
use App\Http\Controllers\DaftarBoxController;
use App\Http\Controllers\DaftarGedungController;
use App\Http\Controllers\DaftarKolomController;
use App\Http\Controllers\DaftarLantaiController;
use App\Http\Controllers\DaftarRakController;
use App\Http\Controllers\DaftarRuangController;
use App\Http\Controllers\DropdownController;
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
use App\Http\Controllers\IncommingMailController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\OutgoingMailController;
use App\Http\Controllers\MappingLokasiSimpanController;
use App\Http\Controllers\PatternController;
use App\Http\Controllers\SatorController;
use App\Http\Controllers\SaveLocationMapController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UnitLetterController;
use App\Http\Controllers\WorkUnitController;
use App\Models\Dropdown;
use Carbon\Carbon;
use App\Models\User;
use PgSql\Lob;

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
Route::controller(FrondandController::class)->group(function () {
    Route::get('/', 'login')->name('login');
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

    //opd
    Route::controller(OpdController::class)->group(function () {
        Route::get('/opd', 'index');
        Route::get('/create-opd', 'create');
        Route::post('/opd', 'store');
        Route::get('/opd/edit/{id}', 'edit');
        Route::patch('/opd/update/{opd}', 'update');
        Route::delete('/opd/{id}/destroy', 'destroy');   
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

//Lokasi Simpan
Route::middleware(['auth'])->group(function () {
    // MASTER
    Route::resource('gedung', DaftarGedungController::class);
    Route::patch('/gedung/aktif/{id}', [DaftarGedungController::class, 'aktif']);
    
Route::resource('lantai', DaftarLantaiController::class);
    Route::patch('/lantai/aktif/{id}', [DaftarLantaiController::class, 'aktif']);

Route::resource('ruang', DaftarRuangController::class);
Route::patch('/ruang/aktif/{id}', [DaftarRuangController::class, 'aktif']);

Route::resource('rak', DaftarRakController::class);
Route::patch('/rak/aktif/{id}', [DaftarRakController::class, 'aktif']);

Route::resource('baris', DaftarBarisController::class);
Route::patch('/baris/aktif/{id}', [DaftarBarisController::class, 'aktif']);

Route::resource('kolom', DaftarKolomController::class);
Route::patch('/kolom/aktif/{id}', [DaftarKolomController::class, 'aktif']);

Route::resource('boks', DaftarBoxController::class);
Route::patch('/boks/aktif/{id}', [DaftarBoxController::class, 'aktif']);

//ajax lokasi simpan
Route::get('/mapping-lantai/{gedungId}', [MappingLokasiSimpanController::class, 'getLantai'])->name('mappingLantai');
Route::get('/mapping-ruang/{lantaiId}', [MappingLokasiSimpanController::class, 'getRuang'])->name('mappingRuang');
Route::get('/mapping-rak/{ruangId}', [MappingLokasiSimpanController::class, 'getRak'])->name('mappingRak');
Route::get('/mapping-baris/{rakId}', [MappingLokasiSimpanController::class, 'getBaris'])->name('mappingBaris');
Route::get('/mapping-kolom/{barisId}', [MappingLokasiSimpanController::class, 'getKolom'])->name('mappingKolom');

    //Parameters
    Route::resource('instansi', InstansiController::class);
    Route::patch('/instansi/aktif/{id}', [InstansiController::class, 'aktif']);

    Route::resource('sator', SatorController::class);
    Route::patch('/sator/aktif/{id}', [SatorController::class, 'aktif']);

    Route::resource('unitkerja', WorkUnitController::class);
    Route::patch('/unitkerja/aktif/{id}', [WorkUnitController::class, 'aktif']);

    Route::resource('klasifikasi', ClassificationController::class);
    Route::patch('/klasifikasi/aktif/{id}', [ClassificationController::class, 'aktif']);

    Route::resource('naskah', LetterController::class);
    Route::patch('/naskah/aktif/{id}', [LetterController::class, 'aktif']);
    Route::post('/pattern/store/{id}', [LetterController::class, 'storePattern']);
    Route::get('/pattern/create/{id}', [LetterController::class, 'createPattern']);

    Route::resource('pengaduan', ComplainController::class);
    Route::patch('/pengaduan/aktif/{id}', [ComplainController::class, 'aktif']);

    Route::resource('satnas', UnitLetterController::class);
    Route::patch('/satnas/aktif/{id}', [UnitLetterController::class, 'aktif']);

    Route::resource('template', TemplateController::class);
    Route::patch('/template/aktif/{id}', [TemplateController::class, 'aktif']);
Route::get('/list-template-keluar', [TemplateController::class, 'listTemplateKeluar']);

    Route::resource('dropdown', DropdownController::class);
    Route::patch('/dropdown/aktif/{id}', [DropdownController::class, 'aktif']);

    //SURAT
    //SURAT MASUK
    Route::controller(IncommingMailController::class)->group(function () {
        Route::prefix('surat-masuk')->group(function () {
            Route::get('/', 'index')->name('incommingmail.index');
            Route::get('/tambah', 'create')->name('incommingmail.create');
        });
    });
    //SURAT KELUAR
    Route::controller(OutgoingMailController::class)->group(function () {
        Route::prefix('surat-keluar')->group(function () {
            Route::get('/', 'index')->name('outgoingmail.index');
            Route::post('/', 'index')->name('outgoingmail.index');
            Route::get('/tambah', 'create')->name('outgoingmail.create');
            Route::post('/store', 'store')->name('outgoingmail.store');
            Route::post('/store/bulk', 'storebulk')->name('outgoingmail.storebulk');
            Route::get('/detail/{id}', 'detail')->name('outgoingmail.detail');
            Route::get('/ubah/{id}', 'edit')->name('outgoingmail.edit');
            Route::post('/update/{id}', 'update')->name('outgoingmail.update');
            Route::get('/checkpattern/{id}', 'checkpattern')->name('outgoingmail.checkpattern');

            Route::post('/generate', 'generatenumber')->name('outgoingmail.generate');
        });
    });
    //MAP SAVE LOCATION
    Route::controller(SaveLocationMapController::class)->group(function () {
        Route::prefix('map-save-location')->group(function () {
            Route::get('/listLantai/{id}', 'listLantai')->name('mapsaveloc.listLantai');
            Route::get('/listRuang/{id}', 'listRuang')->name('mapsaveloc.listRuang');
            Route::get('/listRak/{id}', 'listRak')->name('mapsaveloc.listRak');
            Route::get('/listBaris/{id}', 'listBaris')->name('mapsaveloc.listBaris');
            Route::get('/listKolom/{id}', 'listKolom')->name('mapsaveloc.listKolom');
            Route::get('/listBoks/{id}', 'listBoks')->name('mapsaveloc.listBoks');
        });
    });
});

require __DIR__.'/auth.php';