@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-clipboard-list"></i> Detail Rekam Medis</h2>
        <a href="{{ route('perawat.detail-rekam.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Detail
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
                            <th>Tanggal Rekam Medis</th>
                            <th>No. Urut</th>
                            <th>Nama Pet</th>
                            <th>Kode Tindakan</th>
                            <th>Nama Tindakan</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detailRekam as $index => $detail)
                        <tr>
                            <td>{{ $detailRekam->firstItem() + $index }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($detail->rekamMedis->created_at)) }}</td>
                            <td>{{ $detail->rekamMedis->temuDokter->no_urut ?? '-' }}</td>
                            <td>{{ $detail->rekamMedis->temuDokter->pet->nama ?? '-' }}</td>
                            <td>{{ $detail->kodeTindakan->kode ?? '-' }}</td>
                            <td>{{ $detail->kodeTindakan->nama_tindakan ?? '-' }}</td>
                            <td>{{ Str::limit($detail->detail, 50) ?? '-' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('perawat.detail-rekam.edit', $detail->iddetail_rekam_medis) }}" 
                                       class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('perawat.detail-rekam.destroy', $detail->iddetail_rekam_medis) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus detail ini?')">
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
                                <p class="text-muted">Belum ada detail rekam medis</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $detailRekam->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
