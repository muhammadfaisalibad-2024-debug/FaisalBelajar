@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-user-tie"></i> Dashboard Resepsionis</h2>
        <p class="text-muted">Selamat datang, {{ Auth::user()->nama }}</p>
    </div>

    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Total Pemilik</h6>
                            <h3 class="mb-0">{{ \App\Models\Owner::count() }}</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-users fa-2x text-primary"></i>
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
                            <i class="fas fa-paw fa-2x text-success"></i>
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
                            <h6 class="text-muted mb-1">Janji Temu Hari Ini</h6>
                            <h3 class="mb-0">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-calendar-check fa-2x text-info"></i>
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
                            <h6 class="text-muted mb-1">Pemilik Baru Bulan Ini</h6>
                            <h3 class="mb-0">0</h3>
                        </div>
                        <div class="ms-3">
                            <i class="fas fa-user-plus fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Utama Resepsionis -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-users fa-4x text-primary mb-3"></i>
                    <h5 class="card-title">Data Pemilik</h5>
                    <p class="card-text text-muted">Kelola data pemilik hewan peliharaan</p>
                    <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Kelola
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-paw fa-4x text-success mb-3"></i>
                    <h5 class="card-title">Data Hewan</h5>
                    <p class="card-text text-muted">Kelola data hewan peliharaan</p>
                    <a href="{{ route('resepsionis.pet.index') }}" class="btn btn-success">
                        <i class="fas fa-arrow-right"></i> Kelola
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-calendar-alt fa-4x text-info mb-3"></i>
                    <h5 class="card-title">Temu Dokter</h5>
                    <p class="card-text text-muted">Kelola janji temu dengan dokter</p>
                    <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-info text-white">
                        <i class="fas fa-arrow-right"></i> Buka
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm hover-card">
                <div class="card-body text-center p-4">
                    <i class="fas fa-user-plus fa-4x text-warning mb-3"></i>
                    <h5 class="card-title">Tambah Pemilik</h5>
                    <p class="card-text text-muted">Daftar pemilik baru</p>
                    <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-warning">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-outline-primary text-start">
                            <i class="fas fa-user-plus"></i> Tambah Pemilik Baru
                        </a>
                        <a href="{{ route('resepsionis.pet.create') }}" class="btn btn-outline-success text-start">
                            <i class="fas fa-paw"></i> Tambah Hewan Baru
                        </a>
                        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-outline-info text-start">
                            <i class="fas fa-calendar-plus"></i> Buat Janji Temu
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Janji Temu Hari Ini</h5>
                </div>
                <div class="card-body">
                    @php
                        $todayAppointments = \App\Models\TemuDokter::with(['pet.owner', 'roleUser.user'])
                            ->whereDate('waktu_daftar', today())
                            ->orderBy('no_urut')
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @if($todayAppointments->count() > 0)
                        <div class="list-group">
                            @foreach($todayAppointments as $apt)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">
                                            <span class="badge bg-secondary">No. {{ $apt->no_urut }}</span> 
                                            {{ $apt->pet->nama ?? '-' }}
                                        </h6>
                                        <small class="text-muted">
                                            {{ $apt->pet->owner->nama ?? '-' }} | 
                                            Dr. {{ $apt->roleUser->user->nama ?? '-' }} |
                                            {{ \Carbon\Carbon::parse($apt->waktu_daftar)->format('H:i') }}
                                        </small>
                                    </div>
                                    <span class="badge bg-{{ $apt->status == '1' ? 'info' : ($apt->status == '0' ? 'warning' : ($apt->status == '2' ? 'success' : 'danger')) }}">
                                        {{ $apt->status == '0' ? 'Pending' : ($apt->status == '1' ? 'Confirmed' : ($apt->status == '2' ? 'Completed' : 'Cancelled')) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center mb-0">Tidak ada janji temu hari ini</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Pemilik Terbaru</h5>
                </div>
                <div class="card-body">
                    @php
                        $recentOwners = \App\Models\Owner::with('user')->orderBy('idpemilik', 'desc')->limit(5)->get();
                    @endphp
                    
                    @if($recentOwners->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. WA</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOwners as $owner)
                                    <tr>
                                        <td>{{ $owner->user->nama ?? '-' }}</td>
                                        <td>{{ $owner->user->email ?? '-' }}</td>
                                        <td>{{ $owner->no_wa ?? '-' }}</td>
                                        <td>{{ Str::limit($owner->alamat, 30) ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('resepsionis.pemilik.edit', $owner->idpemilik) }}" 
                                               class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center">Belum ada data pemilik</p>
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


