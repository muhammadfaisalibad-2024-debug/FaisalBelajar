@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Jadwal Temu Dokter</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0"><i class="fas fa-calendar-alt text-primary"></i> Jadwal Temu Dokter</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No. Urut</th>
                            <th>Tanggal & Waktu</th>
                            <th>Hewan</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $index => $appointment)
                        <tr>
                            <td>{{ $appointments->firstItem() + $index }}</td>
                            <td><span class="badge bg-primary">{{ $appointment->no_urut }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($appointment->waktu_daftar)->format('d/m/Y H:i') }}</td>
                            <td><strong>{{ $appointment->pet_name }}</strong></td>
                            <td>Dr. {{ $appointment->dokter_name }}</td>
                            <td>{{ Str::limit($appointment->keluhan, 50) }}</td>
                            <td>
                                @if($appointment->status == 1)
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif($appointment->status == 2)
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-secondary">Dibatalkan</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada jadwal temu dokter
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $appointments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
