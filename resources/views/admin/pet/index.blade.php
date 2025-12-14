@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-paw"></i> Data Hewan Peliharaan</h2>
        <a href="{{ route('admin.pet.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pet
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pet</th>
                            <th>Pemilik</th>
                            <th>Jenis Hewan</th>
                            <th>Ras</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Warna/Tanda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pets as $index => $pet)
                            <tr>
                                <td>{{ $pets->firstItem() + $index }}</td>
                                <td><strong>{{ $pet->nama }}</strong></td>
                                <td>{{ $pet->owner->user->nama ?? '-' }}</td>
                                <td>{{ $pet->animalBreed->animalType->nama_jenis_hewan ?? '-' }}</td>
                                <td>{{ $pet->animalBreed->nama_ras ?? '-' }}</td>
                                <td>
                                    @if($pet->jenis_kelamin == 'L')
                                        <span class="badge bg-primary">Jantan</span>
                                    @else
                                        <span class="badge bg-danger">Betina</span>
                                    @endif
                                </td>
                                <td>{{ $pet->tanggal_lahir ? $pet->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                                <td>{{ $pet->warna_tanda ?? '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.pet.edit', $pet->idpet) }}" 
                                           class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pet.destroy', $pet->idpet) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data hewan peliharaan.</td>
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

