@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-calendar-alt"></i> Temu Dokter</h2>
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Janji Temu
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
                            <th>Dokter</th>
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
                            <td>{{ $temu->roleUser->user->nama ?? '-' }}</td>
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
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('resepsionis.temu-dokter.edit', $temu->idreservasi_dokter) }}" 
                                       class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('resepsionis.temu-dokter.destroy', $temu->idreservasi_dokter) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada reservasi dokter</p>
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


