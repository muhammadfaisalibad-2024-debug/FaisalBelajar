<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AnimalTypeController;
use App\Http\Controllers\AnimalBreedController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClinicalCategoryController;
use App\Http\Controllers\TherapyActionCodeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Admin\DokterController as AdminDokterController;
use App\Http\Controllers\Admin\PerawatController as AdminPerawatController;
use App\Http\Controllers\Admin\TemuDokterController as AdminTemuDokterController;
use App\Http\Controllers\Admin\RekamMedisController as AdminRekamMedisController;
use App\Http\Controllers\Admin\DetailRekamController as AdminDetailRekamController;
use App\Http\Controllers\Perawat\PerawatDashboardController;
use App\Http\Controllers\Perawat\RekamMedisController;
use App\Http\Controllers\Perawat\DetailRekamController as PerawatDetailRekamController;
use App\Http\Controllers\Resepsionis\ResepsonisDashboardController;
use App\Http\Controllers\Resepsionis\TemuDokterController;
use App\Http\Controllers\Dokter\DokterDashboardController;
use App\Http\Controllers\Dokter\DetailRekamController as DokterDetailRekamController;
use App\Http\Controllers\Pemilik\PemilikDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');

Route::get('/visi-misi', function () {
    return view('visi-misi');
})->name('visi-misi');

Route::get('/struktur-organisasi', function () {
    return view('struktur-org');
})->name('struktur-org');

// Laravel UI Authentication Routes
Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Admin Dashboard & Master Data
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Admin CRUD for Master Data
        Route::resource('dokter', AdminDokterController::class);
        Route::resource('perawat', AdminPerawatController::class);
        Route::resource('users', UserController::class);
        Route::resource('pemilik', OwnerController::class);
        Route::resource('pet', PetController::class);
        Route::resource('jenis-hewan', AnimalTypeController::class);
        Route::resource('ras-hewan', AnimalBreedController::class);
        Route::resource('kategori', CategoryController::class);
        Route::resource('kategori-klinis', ClinicalCategoryController::class);
        Route::resource('kode-tindakan-terapi', TherapyActionCodeController::class);
        Route::resource('role', RoleController::class);
        
        // Admin CRUD for Transactional Data
        Route::resource('temu-dokter', AdminTemuDokterController::class);
        Route::resource('rekam-medis', AdminRekamMedisController::class);
        Route::resource('detail-rekam', AdminDetailRekamController::class);
    });
    
    // API Routes
    Route::get('/api/breeds/{animalTypeId}', [PetController::class, 'getBreedsByType'])->name('api.breeds');
    
    // Perawat Routes
    Route::prefix('perawat')->name('perawat.')->group(function () {
        Route::get('/dashboard', [PerawatDashboardController::class, 'index'])->name('dashboard');
        Route::get('/pasien', [PerawatDashboardController::class, 'pasien'])->name('pasien');
        Route::get('/profil', [PerawatDashboardController::class, 'profil'])->name('profil');
        
        Route::resource('rekam-medis', RekamMedisController::class)->names([
            'index' => 'rekam-medis.index',
            'create' => 'rekam-medis.create',
            'store' => 'rekam-medis.store',
            'show' => 'rekam-medis.show',
            'edit' => 'rekam-medis.edit',
            'update' => 'rekam-medis.update',
            'destroy' => 'rekam-medis.destroy',
        ]);
        
        // Detail Rekam Medis (View Only for Perawat)
        Route::get('detail-rekam', [PerawatDetailRekamController::class, 'index'])->name('detail-rekam.index');
    });
    
    // Resepsionis Routes
    Route::prefix('resepsionis')->name('resepsionis.')->group(function () {
        Route::get('/dashboard', [ResepsonisDashboardController::class, 'index'])->name('dashboard');
        
        // CRUD Pet dan Pemilik
        Route::resource('pemilik', OwnerController::class);
        Route::resource('pet', PetController::class);
        
        // CRUD Temu Dokter
        Route::resource('temu-dokter', TemuDokterController::class)->names([
            'index' => 'temu-dokter.index',
            'create' => 'temu-dokter.create',
            'store' => 'temu-dokter.store',
            'edit' => 'temu-dokter.edit',
            'update' => 'temu-dokter.update',
            'destroy' => 'temu-dokter.destroy',
        ])->except(['show']);
    });
    
    // Dokter Routes
    Route::prefix('dokter')->name('dokter.')->group(function () {
        Route::get('/dashboard', [DokterDashboardController::class, 'index'])->name('dashboard');
        Route::get('/pasien', [DokterDashboardController::class, 'pasien'])->name('pasien');
        Route::get('/profil', [DokterDashboardController::class, 'profil'])->name('profil');
        
        // Rekam Medis (View Only)
        Route::get('/rekam-medis', [DokterDashboardController::class, 'rekamMedis'])->name('rekam-medis.index');
        Route::get('/rekam-medis/{id}', [DokterDashboardController::class, 'showRekamMedis'])->name('rekam-medis.show');
        
        // Detail Rekam Medis (CRUD)
        Route::resource('detail-rekam', DokterDetailRekamController::class)->names([
            'index' => 'detail-rekam.index',
            'create' => 'detail-rekam.create',
            'store' => 'detail-rekam.store',
            'edit' => 'detail-rekam.edit',
            'update' => 'detail-rekam.update',
            'destroy' => 'detail-rekam.destroy',
        ])->except(['show']);
    });
    
    // Pemilik Routes
    Route::prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/dashboard', [PemilikDashboardController::class, 'index'])->name('dashboard');
        Route::get('/jadwal', [PemilikDashboardController::class, 'jadwal'])->name('jadwal');
        Route::get('/rekam-medis', [PemilikDashboardController::class, 'rekamMedis'])->name('rekam-medis');
        Route::get('/rekam-medis/{id}', [PemilikDashboardController::class, 'showRekamMedis'])->name('rekam-medis.show');
        Route::get('/profil', [PemilikDashboardController::class, 'profil'])->name('profil');
    });
    
    // Legacy dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Home route (from Laravel UI)
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.dashboard');
});
