@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2><i class="fas fa-paw"></i> Detail Pasien</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dokter.pet.index') }}">Data Pasien</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Informasi Pasien</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">Nama Pet</th>
                    <td>{{ $pet->nama }}</td>
                </tr>
                <tr>
                    <th>Pemilik</th>
                    <td>{{ $pet->owner->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jenis Hewan</th>
                    <td>{{ $pet->animalType->nama_jenis ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Ras</th>
                    <td>{{ $pet->animalBreed->nama_ras ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $pet->tanggal_lahir ? date('d F Y', strtotime($pet->tanggal_lahir)) : '-' }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $pet->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}</td>
                </tr>
                <tr>
                    <th>Warna</th>
                    <td>{{ $pet->warna ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Ciri Khusus</th>
                    <td>{{ $pet->ciri_khusus ?? '-' }}</td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="{{ route('dokter.pet.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
