@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-user-nurse"></i> Dashboard Perawat</h2>
        <p class="text-muted">Selamat datang, {{ Auth::user()->nama }}</p>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Total Rekam Medis</h6>
                            <h3 class="mb-0">{{ \App\Models\RekamMedis::count() ?? 0 }}</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-file-medical fa-2x text-primary"></i>
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
                            <h6 class="text-muted mb-1">Pasien Hari Ini</h6>
                            <h3 class="mb-0">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-calendar-day fa-2x text-success"></i>
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
                            <h6 class="text-muted mb-1">Total Pemilik</h6>
                            <h3 class="mb-0">{{ \App\Models\Owner::count() }}</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-users fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Utama Perawat -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-file-medical fa-4x text-primary mb-3"></i>
                    <h5 class="card-title">Rekam Medis</h5>
                    <p class="card-text text-muted">Kelola rekam medis hewan peliharaan</p>
                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Buka
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-clipboard-list fa-4x text-success mb-3"></i>
                    <h5 class="card-title">Detail Rekam Medis</h5>
                    <p class="card-text text-muted">Kelola detail pemeriksaan & tindakan</p>
                    <a href="{{ route('perawat.detail-rekam.index') }}" class="btn btn-success">
                        <i class="fas fa-arrow-right"></i> Buka
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-paw fa-4x text-info mb-3"></i>
                    <h5 class="card-title">Data Hewan</h5>
                    <p class="card-text text-muted">Lihat data hewan peliharaan</p>
                    <a href="{{ route('pet.index') }}" class="btn btn-info text-white">
                        <i class="fas fa-arrow-right"></i> Buka
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Rekam Medis -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Rekam Medis Terbaru</h5>
                </div>
                <div class="card-body">
                    @php
                        $recentRM = \App\Models\RekamMedis::with(['temuDokter.pet.owner', 'dokter'])
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @if($recentRM->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>No. Urut</th>
                                        <th>Pet</th>
                                        <th>Pemilik</th>
                                        <th>Anamnesa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentRM as $rm)
                                    <tr>
                                        <td>{{ date('d/m/Y H:i', strtotime($rm->created_at)) }}</td>
                                        <td><span class="badge bg-secondary">{{ $rm->temuDokter->no_urut ?? '-' }}</span></td>
                                        <td>{{ $rm->temuDokter->pet->nama ?? '-' }}</td>
                                        <td>{{ $rm->temuDokter->pet->owner->nama ?? '-' }}</td>
                                        <td>{{ Str::limit($rm->anamnesa, 40) }}</td>
                                        <td>
                                            <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}" 
                                               class="btn btn-sm btn-info text-white">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center">Belum ada rekam medis</p>
                    @endif
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
