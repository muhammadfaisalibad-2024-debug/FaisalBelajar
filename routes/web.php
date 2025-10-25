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
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Public routes
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

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Users Management
    Route::resource('user', UserController::class);
    
    // Owners Management
    Route::resource('pemilik', OwnerController::class);
    
    // Pets Management
    Route::resource('pet', PetController::class);
    
    // Animal Types Management
    Route::resource('jenis-hewan', AnimalTypeController::class);
    
    // Animal Breeds Management
    Route::resource('ras-hewan', AnimalBreedController::class);
    
    // API for getting breeds by animal type (for AJAX)
    Route::get('/api/breeds/{animalTypeId}', [PetController::class, 'getBreedsByType'])
        ->name('api.breeds');
    
    // Category Management
    Route::resource('kategori', CategoryController::class);
    
    // Clinical Category Management
    Route::resource('kategori-klinis', ClinicalCategoryController::class);
    
    // Therapy Action Code Management
    Route::resource('kode-tindakan-terapi', TherapyActionCodeController::class);
    
    // Role Management
    Route::resource('role', RoleController::class);
});

