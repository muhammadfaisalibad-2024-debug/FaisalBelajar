@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><i class="fas fa-clipboard-list text-primary"></i> Detail Rekam Medis</h2>
            <p class="text-muted">Kelola detail tindakan terapi pada rekam medis</p>
        </div>
        <a href="{{ route('dokter.detail-rekam.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Detail
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
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
                            <th>Tanggal Rekam</th>
                            <th>Nama Hewan</th>
                            <th>Kode Tindakan</th>
                            <th>Deskripsi Tindakan</th>
                            <th>Detail</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($details as $index => $detail)
                        <tr>
                            <td>{{ $details->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($detail->tanggal_rekam)->format('d/m/Y') }}</td>
                            <td><strong>{{ $detail->pet_name }}</strong></td>
                            <td><span class="badge bg-info">{{ $detail->kode }}</span></td>
                            <td>{{ $detail->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $detail->detail ?? '-' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('dokter.detail-rekam.edit', $detail->iddetail_rekam_medis) }}" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('dokter.detail-rekam.destroy', $detail->iddetail_rekam_medis) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Yakin ingin menghapus?')" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada detail rekam medis
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $details->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
