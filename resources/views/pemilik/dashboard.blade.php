@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h2><i class="fas fa-home text-primary"></i> Dashboard Pemilik</h2>
            <p class="text-muted">Selamat datang, {{ $pemilik->nama }}</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-2">Total Hewan Peliharaan</h6>
                            <h2 class="mb-0">{{ $totalPets }}</h2>
                        </div>
                        <i class="fas fa-paw fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-2">Jadwal Mendatang</h6>
                            <h2 class="mb-0">{{ $upcomingAppointments }}</h2>
                        </div>
                        <i class="fas fa-calendar-check fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-2">Total Rekam Medis</h6>
                            <h2 class="mb-0">{{ $totalRekamMedis }}</h2>
                        </div>
                        <i class="fas fa-file-medical fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-calendar-alt fa-4x text-primary mb-3"></i>
                    <h5 class="card-title">Jadwal Temu Dokter</h5>
                    <p class="card-text text-muted">Lihat jadwal janji dengan dokter</p>
                    <a href="{{ route('pemilik.jadwal') }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> Lihat Jadwal
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-notes-medical fa-4x text-success mb-3"></i>
                    <h5 class="card-title">Rekam Medis</h5>
                    <p class="card-text text-muted">Lihat riwayat rekam medis hewan</p>
                    <a href="{{ route('pemilik.rekam-medis') }}" class="btn btn-success">
                        <i class="fas fa-eye"></i> Lihat Rekam Medis
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-user fa-4x text-info mb-3"></i>
                    <h5 class="card-title">Profil & Hewan</h5>
                    <p class="card-text text-muted">Lihat profil dan hewan peliharaan</p>
                    <a href="{{ route('pemilik.profil') }}" class="btn btn-info text-white">
                        <i class="fas fa-eye"></i> Lihat Profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Appointments -->
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-calendar text-primary"></i> Jadwal Terbaru</h5>
                </div>
                <div class="card-body">
                    @forelse($recentAppointments as $appointment)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <div>
                            <h6 class="mb-1">{{ $appointment->pet_name }}</h6>
                            <small class="text-muted">
                                <i class="fas fa-user-md"></i> Dr. {{ $appointment->dokter_name }}
                            </small>
                            <br>
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($appointment->waktu_daftar)->format('d/m/Y H:i') }}
                            </small>
                        </div>
                        <span class="badge 
                            @if($appointment->status == 1) bg-warning 
                            @elseif($appointment->status == 2) bg-success 
                            @else bg-secondary @endif">
                            @if($appointment->status == 1) Menunggu
                            @elseif($appointment->status == 2) Selesai
                            @else Dibatalkan @endif
                        </span>
                    </div>
                    @empty
                    <p class="text-center text-muted mb-0">Belum ada jadwal</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-paw text-success"></i> Hewan Peliharaan Saya</h5>
                </div>
                <div class="card-body">
                    @forelse($myPets as $pet)
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                        <div>
                            <h6 class="mb-1">{{ $pet->nama }}</h6>
                            <small class="text-muted">
                                {{ $pet->nama_jenis_hewan ?? '-' }} - {{ $pet->nama_ras ?? '-' }}
                            </small>
                            <br>
                            <small class="text-muted">
                                {{ $pet->jenis_kelamin }} | Umur: {{ $pet->umur ?? '-' }}
                            </small>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-muted mb-0">Belum ada hewan peliharaan</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
