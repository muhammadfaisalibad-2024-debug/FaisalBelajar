@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-file-medical"></i> Rekam Medis</h2>
        <a href="{{ route('perawat.rekam-medis.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Rekam Medis
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
                            <th>Tanggal</th>
                            <th>No. Urut</th>
                            <th>Nama Pet</th>
                            <th>Pemilik</th>
                            <th>Anamnesa</th>
                            <th>Diagnosa</th>
                            <th>Dokter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis as $index => $rm)
                        <tr>
                            <td>{{ $rekamMedis->firstItem() + $index }}</td>
                            <td>{{ $rm->created_at ? date('d/m/Y', strtotime($rm->created_at)) : '-' }}</td>
                            <td>{{ $rm->temuDokter->no_urut ?? '-' }}</td>
                            <td>{{ $rm->temuDokter->pet->nama ?? '-' }}</td>
                            <td>{{ $rm->temuDokter->pet->owner->nama ?? '-' }}</td>
                            <td>{{ Str::limit($rm->anamnesa, 50) ?? '-' }}</td>
                            <td>{{ Str::limit($rm->diagnosa, 50) ?? '-' }}</td>
                            <td>{{ $rm->dokter->nama ?? '-' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}" 
                                       class="btn btn-info text-white" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('perawat.rekam-medis.edit', $rm->idrekam_medis) }}" 
                                       class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('perawat.rekam-medis.destroy', $rm->idrekam_medis) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus rekam medis ini?')">
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
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada data rekam medis</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $rekamMedis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
