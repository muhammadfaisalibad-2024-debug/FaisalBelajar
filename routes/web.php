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
   
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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
