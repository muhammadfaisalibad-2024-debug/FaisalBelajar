@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-file-medical-fill"></i> Rekam Medis</h2>
        <a href="{{ route('admin.rekam-medis.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Rekam Medis
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No. Urut</th>
                            <th>Hewan</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis as $index => $rm)
                        <tr>
                            <td>{{ $rekamMedis->firstItem() + $index }}</td>
                            <td>{{ $rm->created_at ? \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y') : '-' }}</td>
                            <td><span class="badge bg-primary">{{ $rm->no_urut }}</span></td>
                            <td>{{ $rm->pet_name }}</td>
                            <td>{{ $rm->owner_name }}</td>
                            <td>{{ $rm->dokter_name }}</td>
                            <td>{{ Str::limit($rm->diagnosa, 50) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.rekam-medis.show', $rm->idrekam_medis) }}" 
                                       class="btn btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.rekam-medis.edit', $rm->idrekam_medis) }}" 
                                       class="btn btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.rekam-medis.destroy', $rm->idrekam_medis) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada data rekam medis</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $rekamMedis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
