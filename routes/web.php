<?php

use App\Http\Controllers\Admin\AlumniController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CeritaAlumniController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FasilitasController;
use App\Http\Controllers\Admin\JadwalHarianController;
use App\Http\Controllers\Admin\MasayikhController;
use App\Http\Controllers\Admin\PendidikanFormalController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\PsbBiayaController;
use App\Http\Controllers\Admin\PsbController;
use App\Http\Controllers\Admin\SantriController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Pondok Pesantren Miftahul Ulum Gunung Bubut
|--------------------------------------------------------------------------
*/

// ========================
// PUBLIC LANDING PAGE
// ========================
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/profil', [LandingController::class, 'profil'])->name('profil');
Route::get('/asrama', [LandingController::class, 'asrama'])->name('asrama');
Route::get('/pendidikan-formal', [LandingController::class, 'pendidikan'])->name('pendidikan');
Route::get('/pendidikan-formal/mts', [LandingController::class, 'pendidikanMts'])->name('pendidikan.mts');
Route::get('/pendidikan-formal/smk', [LandingController::class, 'pendidikanSmk'])->name('pendidikan.smk');
Route::get('/publikasi', [LandingController::class, 'publikasi'])->name('publikasi');
Route::get('/publikasi/{slug}', [LandingController::class, 'publikasiDetail'])->name('publikasi.detail');
Route::get('/psb', [LandingController::class, 'psb'])->name('psb');
Route::post('/psb', [LandingController::class, 'psbStore'])->name('psb.store');
Route::get('/alumni', [LandingController::class, 'alumni'])->name('alumni');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [LandingController::class, 'kontakKirim'])->name('kontak.kirim');

// ========================
// AUTHENTICATION
// ========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========================
// ADMIN BACKEND PANEL
// ========================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pengelolaan Artikel & Publikasi (Accessible by SuperAdmin & Penulis)
    Route::resource('articles', ArticleController::class);

    // SuperAdmin Only Routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    Route::resource('masayikh', MasayikhController::class)->except(['create', 'show', 'edit']);
    
    // Database Santri Export, Import & Bulk Action
    Route::get('/santri/export', [SantriController::class, 'export'])->name('santri.export');
    Route::get('/santri/template', [SantriController::class, 'template'])->name('santri.template');
    Route::post('/santri/import', [SantriController::class, 'import'])->name('santri.import');
    Route::post('/santri/bulk-delete', [SantriController::class, 'bulkDelete'])->name('santri.bulk-delete');
    Route::resource('santri', SantriController::class)->except(['create', 'show', 'edit']);
    Route::resource('jadwal', JadwalHarianController::class)->except(['create', 'show', 'edit']);
    Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni.index');
    Route::resource('cerita-alumni', CeritaAlumniController::class)->except(['create', 'show', 'edit']);

    // Pendidikan Formal (MTs & SMK YAPIM)
    Route::get('/pendidikan/mts', [PendidikanFormalController::class, 'mts'])->name('pendidikan.mts');
    Route::get('/pendidikan/smk', [PendidikanFormalController::class, 'smk'])->name('pendidikan.smk');
    Route::put('/pendidikan/{kode}', [PendidikanFormalController::class, 'update'])->name('pendidikan.update');
    Route::post('/pendidikan/{kode}/article', [PendidikanFormalController::class, 'storeArticle'])->name('pendidikan.article.store');
    Route::get('/psb', [PsbController::class, 'index'])->name('psb.index');
    Route::post('/psb', [PsbController::class, 'store'])->name('psb.store');
    Route::post('/psb/{registration}/terima', [PsbController::class, 'terimaSantri'])->name('psb.terima');
    Route::patch('/psb/{registration}/status', [PsbController::class, 'updateStatus'])->name('psb.status');
    Route::delete('/psb/{registration}', [PsbController::class, 'destroy'])->name('psb.destroy');

    // Pengaturan Biaya PSB
    Route::get('/psb-biaya', [PsbBiayaController::class, 'index'])->name('psb.biaya.index');
    Route::post('/psb-biaya/batch', [PsbBiayaController::class, 'updateBatch'])->name('psb.biaya.batch');
    Route::resource('psb-biaya-item', PsbBiayaController::class)->except(['create', 'show', 'edit', 'index']);

    // Fasilitas & Prestasi
    Route::resource('fasilitas', FasilitasController::class)->except(['create', 'show', 'edit']);
    Route::resource('prestasi', PrestasiController::class)->except(['create', 'show', 'edit']);

    // Manajemen User
    Route::resource('users', UserController::class)->except(['create', 'show', 'edit']);
});
