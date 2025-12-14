@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Rekam Medis</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0"><i class="fas fa-notes-medical text-success"></i> Rekam Medis Hewan Peliharaan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Hewan</th>
                            <th>Dokter</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis as $index => $rekam)
                        <tr>
                            <td>{{ $rekamMedis->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($rekam->created_at)->format('d/m/Y') }}</td>
                            <td><strong>{{ $rekam->pet_name }}</strong></td>
                            <td>Dr. {{ $rekam->dokter_name }}</td>
                            <td>{{ Str::limit($rekam->diagnosa, 50) }}</td>
                            <td>
                                <a href="{{ route('pemilik.rekam-medis.show', $rekam->idrekam_medis) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada rekam medis
                            </td>
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
