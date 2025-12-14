@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-file-medical"></i> Rekam Medis (View Only)</h2>
    </div>

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
                            <td>{{ \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y H:i') }}</td>
                            <td><span class="badge bg-secondary">{{ $rm->no_urut ?? '-' }}</span></td>
                            <td><strong>{{ $rm->pet_name ?? '-' }}</strong></td>
                            <td>{{ $rm->owner_name ?? '-' }}</td>
                            <td>{{ Str::limit($rm->anamnesa, 40) }}</td>
                            <td>{{ Str::limit($rm->diagnosa, 40) ?? '-' }}</td>
                            <td>Dr. {{ $rm->dokter_name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" 
                                   class="btn btn-info btn-sm text-white" title="Detail">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
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


