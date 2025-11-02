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
use App\Http\Controllers\Perawat\PerawatDashboardController;
use App\Http\Controllers\Perawat\RekamMedisController;
use App\Http\Controllers\Perawat\DetailRekamController;
use App\Http\Controllers\Resepsionis\ResepsonisDashboardController;
use App\Http\Controllers\Resepsionis\TemuDokterController;
use App\Http\Controllers\Dokter\DokterDashboardController;
use App\Http\Controllers\Dokter\DokterRekamMedisController;
use App\Http\Controllers\Dokter\DokterPetController;
use App\Http\Controllers\Dokter\DokterTemuDokterController;
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
    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Perawat Routes
    Route::get('/perawat/dashboard', [PerawatDashboardController::class, 'index'])->name('perawat.dashboard');
    Route::resource('perawat/rekam-medis', RekamMedisController::class)->names([
        'index' => 'perawat.rekam-medis.index',
        'create' => 'perawat.rekam-medis.create',
        'store' => 'perawat.rekam-medis.store',
        'show' => 'perawat.rekam-medis.show',
        'edit' => 'perawat.rekam-medis.edit',
        'update' => 'perawat.rekam-medis.update',
        'destroy' => 'perawat.rekam-medis.destroy',
    ]);
    Route::resource('perawat/detail-rekam', DetailRekamController::class)->names([
        'index' => 'perawat.detail-rekam.index',
        'create' => 'perawat.detail-rekam.create',
        'store' => 'perawat.detail-rekam.store',
        'edit' => 'perawat.detail-rekam.edit',
        'update' => 'perawat.detail-rekam.update',
        'destroy' => 'perawat.detail-rekam.destroy',
    ])->except(['show']);
    
    // Resepsionis Routes
    Route::get('/resepsionis/dashboard', [ResepsonisDashboardController::class, 'index'])->name('resepsionis.dashboard');
    Route::resource('resepsionis/temu-dokter', TemuDokterController::class)->names([
        'index' => 'resepsionis.temu-dokter.index',
        'create' => 'resepsionis.temu-dokter.create',
        'store' => 'resepsionis.temu-dokter.store',
        'edit' => 'resepsionis.temu-dokter.edit',
        'update' => 'resepsionis.temu-dokter.update',
        'destroy' => 'resepsionis.temu-dokter.destroy',
    ])->except(['show']);
    
    // Dokter Routes (View Only)
    Route::get('/dokter/dashboard', [DokterDashboardController::class, 'index'])->name('dokter.dashboard');
    Route::get('/dokter/rekam-medis', [DokterRekamMedisController::class, 'index'])->name('dokter.rekam-medis.index');
    Route::get('/dokter/rekam-medis/{id}', [DokterRekamMedisController::class, 'show'])->name('dokter.rekam-medis.show');
    Route::get('/dokter/pet', [DokterPetController::class, 'index'])->name('dokter.pet.index');
    Route::get('/dokter/pet/{id}', [DokterPetController::class, 'show'])->name('dokter.pet.show');
    Route::get('/dokter/temu-dokter', [DokterTemuDokterController::class, 'index'])->name('dokter.temu-dokter.index');
    Route::get('/dokter/temu-dokter/{id}', [DokterTemuDokterController::class, 'show'])->name('dokter.temu-dokter.show');
    
    // Resource Routes (Admin)
    Route::resource('user', UserController::class);
    Route::resource('pemilik', OwnerController::class);
    Route::resource('pet', PetController::class);
    Route::resource('jenis-hewan', AnimalTypeController::class);
    Route::resource('ras-hewan', AnimalBreedController::class);
    Route::get('/api/breeds/{animalTypeId}', [PetController::class, 'getBreedsByType'])
        ->name('api.breeds');
    Route::resource('kategori', CategoryController::class);
    Route::resource('kategori-klinis', ClinicalCategoryController::class);
    Route::resource('kode-tindakan-terapi', TherapyActionCodeController::class);
    Route::resource('role', RoleController::class);
    
    // Home route (from Laravel UI)
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.dashboard');
});
