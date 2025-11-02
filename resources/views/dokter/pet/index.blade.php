@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-paw"></i> Data Pasien (View Only)</h2>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pet</th>
                            <th>Pemilik</th>
                            <th>Jenis Hewan</th>
                            <th>Ras</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pets as $index => $pet)
                        <tr>
                            <td>{{ $pets->firstItem() + $index }}</td>
                            <td>{{ $pet->nama }}</td>
                            <td>{{ $pet->owner->nama ?? '-' }}</td>
                            <td>{{ $pet->animalType->nama_jenis ?? '-' }}</td>
                            <td>{{ $pet->animalBreed->nama_ras ?? '-' }}</td>
                            <td>{{ $pet->tanggal_lahir ? date('d/m/Y', strtotime($pet->tanggal_lahir)) : '-' }}</td>
                            <td>{{ $pet->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}</td>
                            <td>
                                <a href="{{ route('dokter.pet.show', $pet->idpet) }}" 
                                   class="btn btn-info btn-sm text-white" title="Detail">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada data pet</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $pets->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
