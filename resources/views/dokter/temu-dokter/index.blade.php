@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-calendar-alt"></i> Jadwal Temu Saya</h2>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No. Urut</th>
                            <th>Waktu Daftar</th>
                            <th>Pet</th>
                            <th>Pemilik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($temuDokter as $index => $temu)
                        <tr>
                            <td>{{ $temuDokter->firstItem() + $index }}</td>
                            <td><span class="badge bg-secondary">{{ $temu->no_urut }}</span></td>
                            <td>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d/m/Y H:i') }}</td>
                            <td>{{ $temu->pet->nama ?? '-' }}</td>
                            <td>{{ $temu->pet->owner->nama ?? '-' }}</td>
                            <td>
                                @if($temu->status == '0')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($temu->status == '1')
                                    <span class="badge bg-info">Confirmed</span>
                                @elseif($temu->status == '2')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($temu->status == '3')
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('dokter.temu-dokter.show', $temu->idreservasi_dokter) }}" 
                                   class="btn btn-info btn-sm text-white" title="Detail">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada jadwal reservasi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $temuDokter->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


