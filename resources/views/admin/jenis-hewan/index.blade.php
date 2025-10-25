@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Jenis Hewan</h1>
        <a href="{{ route('jenis-hewan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Jenis Hewan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Jenis Hewan</th>
                            <th width="15%">Jumlah Ras</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($animalTypes as $index => $jenisHewan)
                            <tr>
                                <td>{{ $animalTypes->firstItem() + $index }}</td>
                                <td>{{ $jenisHewan->nama_jenis_hewan }}</td>
                                <td class="text-center">{{ $jenisHewan->breeds_count }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('jenis-hewan.edit', $jenisHewan->idjenis_hewan) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('jenis-hewan.destroy', $jenisHewan->idjenis_hewan) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data jenis hewan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $animalTypes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
