@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2><i class="fas fa-calendar-alt"></i> Detail Janji Temu</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dokter.temu-dokter.index') }}">Jadwal Temu</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Informasi Janji Temu</h5>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">No. Urut</th>
                    <td><span class="badge bg-secondary">{{ $temuDokter->no_urut }}</span></td>
                </tr>
                <tr>
                    <th>Waktu Daftar</th>
                    <td>{{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('d F Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Pet</th>
                    <td>{{ $temuDokter->pet->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Pemilik</th>
                    <td>{{ $temuDokter->pet->owner->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kontak Pemilik</th>
                    <td>{{ $temuDokter->pet->owner->no_telp ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Dokter</th>
                    <td>{{ $temuDokter->roleUser->user->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($temuDokter->status == '0')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($temuDokter->status == '1')
                            <span class="badge bg-info">Confirmed</span>
                        @elseif($temuDokter->status == '2')
                            <span class="badge bg-success">Completed</span>
                        @elseif($temuDokter->status == '3')
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="{{ route('dokter.temu-dokter.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection


