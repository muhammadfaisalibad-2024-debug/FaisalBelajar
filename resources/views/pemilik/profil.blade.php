@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profil Saya</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-user fa-5x text-primary"></i>
                    </div>
                    <h4 class="mb-1">{{ $pemilik->nama }}</h4>
                    <p class="text-muted mb-3">Pemilik Hewan</p>
                    <span class="badge bg-success">Aktif</span>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-info-circle text-primary"></i> Informasi Profil</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">Nama Lengkap</th>
                            <td>: {{ $pemilik->nama }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $pemilik->email }}</td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>: {{ $pemilik->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $pemilik->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Hewan Peliharaan -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-paw text-success"></i> Hewan Peliharaan Saya</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($pets as $pet)
                        <div class="col-md-4 mb-3">
                            <div class="card border">
                                <div class="card-body">
                                    <h6 class="card-title"><i class="fas fa-paw text-success"></i> {{ $pet->nama }}</h6>
                                    <hr>
                                    <p class="mb-1"><small><strong>Jenis:</strong> {{ $pet->nama_jenis_hewan ?? '-' }}</small></p>
                                    <p class="mb-1"><small><strong>Ras:</strong> {{ $pet->nama_ras ?? '-' }}</small></p>
                                    <p class="mb-1"><small><strong>Jenis Kelamin:</strong> {{ $pet->jenis_kelamin }}</small></p>
                                    <p class="mb-0"><small><strong>Umur:</strong> {{ $pet->umur ?? '-' }}</small></p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <p class="text-center text-muted mb-0">Belum ada hewan peliharaan</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
