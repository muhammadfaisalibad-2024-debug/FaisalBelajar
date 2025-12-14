@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-clipboard-list text-info"></i> Detail Rekam Medis (View Only)</h2>
        <p class="text-muted">Lihat detail tindakan terapi pada rekam medis</p>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detailRekam as $index => $detail)
                        <tr>
                            <td>{{ $detailRekam->firstItem() + $index }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($detail->rekamMedis->created_at)) }}</td>
                            <td>{{ $detail->rekamMedis->temuDokter->no_urut ?? '-' }}</td>
                            <td>{{ $detail->rekamMedis->temuDokter->pet->nama ?? '-' }}</td>
                            <td><span class="badge bg-info">{{ $detail->kodeTindakan->kode ?? '-' }}</span></td>
                            <td>{{ $detail->kodeTindakan->deskripsi_tindakan_terapi ?? '-' }}</td>
                            <td>{{ Str::limit($detail->detail, 50) ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
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


