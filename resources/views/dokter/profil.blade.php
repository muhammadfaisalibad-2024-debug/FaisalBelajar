@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profil Dokter</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-user-md fa-5x text-primary"></i>
                    </div>
                    <h4 class="mb-1">{{ $dokter->nama }}</h4>
                    <p class="text-muted mb-3">Dokter Hewan</p>
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
                            <td>: {{ $dokter->nama }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: {{ $dokter->email }}</td>
                        </tr>
                        <tr>
                            <th>No. HP</th>
                            <td>: {{ $dokter->no_hp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Spesialisasi</th>
                            <td>: {{ $dokter->spesialisasi ?? 'Umum' }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $dokter->alamat ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
