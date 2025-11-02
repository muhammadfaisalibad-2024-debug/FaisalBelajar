@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-user-md"></i> Dashboard Dokter</h2>
        <p class="text-muted">Selamat datang, {{ Auth::user()->nama }}</p>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Pasien Hari Ini</h6>
                            <h3 class="mb-0">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-calendar-day fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Total Rekam Medis</h6>
                            <h3 class="mb-0">{{ \App\Models\RekamMedis::count() ?? 0 }}</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-file-medical fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Total Hewan</h6>
                            <h3 class="mb-0">{{ \App\Models\Pet::count() }}</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-paw fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Janji Temu</h6>
                            <h3 class="mb-0">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-calendar-check fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Utama Dokter -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-file-medical fa-4x text-primary mb-3"></i>
                    <h5 class="card-title">Rekam Medis</h5>
                    <p class="card-text text-muted">Lihat rekam medis pasien</p>
                    <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-paw fa-4x text-success mb-3"></i>
                    <h5 class="card-title">Data Pasien</h5>
                    <p class="card-text text-muted">Lihat data hewan peliharaan</p>
                    <a href="{{ route('dokter.pet.index') }}" class="btn btn-success">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-calendar-alt fa-4x text-info mb-3"></i>
                    <h5 class="card-title">Jadwal Temu</h5>
                    <p class="card-text text-muted">Lihat jadwal janji temu</p>
                    <a href="{{ route('dokter.temu-dokter.index') }}" class="btn btn-info text-white">
                        <i class="fas fa-eye"></i> Lihat
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-day"></i> Jadwal Hari Ini</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Belum ada jadwal untuk hari ini.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
}
</style>
@endsection
