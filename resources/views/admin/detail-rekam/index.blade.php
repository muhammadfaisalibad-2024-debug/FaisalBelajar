@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-clipboard2-pulse"></i> Detail Rekam Medis</h2>
        <a href="{{ route('admin.detail-rekam.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Detail Rekam
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Rekam Medis</th>
                            <th>Hewan</th>
                            <th>Kode Tindakan</th>
                            <th>Tindakan</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detailRekam as $index => $dr)
                        <tr>
                            <td>{{ $detailRekam->firstItem() + $index }}</td>
                            <td>#{{ $dr->idrekam_medis }}</td>
                            <td>{{ $dr->pet_name }}</td>
                            <td><span class="badge bg-secondary">{{ $dr->kode }}</span></td>
                            <td>{{ $dr->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $dr->detail ?? '-' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.detail-rekam.show', $dr->iddetail_rekam_medis) }}" 
                                       class="btn btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.detail-rekam.edit', $dr->iddetail_rekam_medis) }}" 
                                       class="btn btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.detail-rekam.destroy', $dr->iddetail_rekam_medis) }}" 
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
                            <td colspan="7" class="text-center text-muted">Tidak ada data detail rekam medis</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $detailRekam->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
