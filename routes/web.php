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
use App\Http\Controllers\KkaTypeController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\OutgoingMailController;
use App\Http\Controllers\MappingLokasiSimpanController;
use App\Http\Controllers\PatternController;
use App\Http\Controllers\SatorController;
use App\Http\Controllers\SaveLocationMapController;
use App\Http\Controllers\SubSatorController;
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

// master
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

    Route::resource('sub-sator', SubSatorController::class);
    Route::patch('/sub-sator/aktif/{id}', [SubSatorController::class, 'aktif']);

    Route::resource('tipe-kka', KkaTypeController::class);
    Route::patch('/tipe-kka/aktif/{id}', [KkaTypeController::class, 'aktif']);
    Route::put('/kka/store/{id}', [KkaTypeController::class, 'storeKKA']);
    Route::get('/kka/{id}', [KkaTypeController::class, 'listKKA']);

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
            Route::post('/', 'index')->name('incommingmail.index');
            Route::post('/directupdate/{id}', 'directupdate')->name('incommingmail.directupdate');
            Route::get('/check-table-changes', 'checkChanges')->name('incommingmail.checkChanges');
            Route::get('/check-table-changes-update', 'checkChangeUpdate')->name('incommingmail.checkChangeUpdate');
            Route::get('/tambah', 'create')->name('incommingmail.create');
            Route::post('/store', 'store')->name('incommingmail.store');
            Route::get('/tambahbulk', 'createbulk')->name('incommingmail.createbulk');
            Route::post('/store/bulk', 'storebulk')->name('incommingmail.storebulk');
            Route::get('/detail/{id}', 'detail')->name('incommingmail.detail');
            Route::get('/ubah/{id}', 'edit')->name('incommingmail.edit');
            Route::post('/update/{id}', 'update')->name('incommingmail.update');
            Route::get('/rekapitulasi', 'rekapitulasi')->name('incommingmail.rekapitulasi');
            Route::post('/rekapitulasi', 'rekapitulasi')->name('incommingmail.rekapitulasi');
            Route::post('/rekapitulasi/Cetak', 'rekapitulasiPrint')->name('incommingmail.rekapitulasiPrint');
        });
    });
    //SURAT KELUAR
    Route::controller(OutgoingMailController::class)->group(function () {
        Route::prefix('surat-keluar')->group(function () {
            Route::get('/', 'index')->name('outgoingmail.index');
            Route::post('/', 'index')->name('outgoingmail.index');
            Route::post('/directupdate/{id}', 'directupdate')->name('outgoingmail.directupdate');
            Route::get('/check-table-changes', 'checkChanges')->name('outgoingmail.checkChanges');
            Route::get('/check-table-changes-update', 'checkChangeUpdate')->name('outgoingmail.checkChangeUpdate');
            Route::get('/tambah', 'create')->name('outgoingmail.create');
            Route::post('/store', 'store')->name('outgoingmail.store');
            Route::get('/tambahbulk', 'createbulk')->name('outgoingmail.createbulk');
            Route::post('/store/bulk', 'storebulk')->name('outgoingmail.storebulk');
            Route::get('/detail/{id}', 'detail')->name('outgoingmail.detail');
            Route::get('/ubah/{id}', 'edit')->name('outgoingmail.edit');
            Route::post('/update/{id}', 'update')->name('outgoingmail.update');
            Route::get('/checkpattern/{id}', 'checkpattern')->name('outgoingmail.checkpattern');
            Route::get('/rekapitulasi', 'rekapitulasi')->name('outgoingmail.rekapitulasi');
            Route::post('/rekapitulasi', 'rekapitulasi')->name('outgoingmail.rekapitulasi');
            Route::post('/rekapitulasi/Cetak', 'rekapitulasiPrint')->name('outgoingmail.rekapitulasiPrint');

            // Route::post('/generate', 'generatenumber')->name('outgoingmail.generate');
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

    //     Route::controller(ProfileOpdController::class)->group(function () {
    //     Route::get('/user/profile', 'index')->middleware(['auth', 'verified'])->name('useropd');
    //     Route::get('/profile/edit', 'edit_profil');
    //     Route::patch('/profile/update', 'update');
    //     Route::patch('/foto-profile/update', 'update_image');
       
    // });

});


require __DIR__.'/auth.php';