@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Pasien</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0"><i class="fas fa-paw text-success"></i> Data Pasien (Hewan Peliharaan)</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Hewan</th>
                            <th>Jenis</th>
                            <th>Ras</th>
                            <th>Jenis Kelamin</th>
                            <th>Umur</th>
                            <th>Pemilik</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pets as $index => $pet)
                        <tr>
                            <td>{{ $pets->firstItem() + $index }}</td>
                            <td><strong>{{ $pet->nama }}</strong></td>
                            <td>{{ $pet->nama_jenis_hewan ?? '-' }}</td>
                            <td>{{ $pet->nama_ras ?? '-' }}</td>
                            <td>
                                @if($pet->jenis_kelamin == 'Jantan')
                                    <span class="badge bg-primary">Jantan</span>
                                @else
                                    <span class="badge bg-danger">Betina</span>
                                @endif
                            </td>
                            <td>{{ $pet->umur ?? '-' }}</td>
                            <td>{{ $pet->pemilik_nama ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                Belum ada data pasien
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $pets->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
