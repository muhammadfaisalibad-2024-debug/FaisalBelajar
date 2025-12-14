@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-hospital"></i> Data Perawat</h2>
        <a href="{{ route('admin.perawat.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Perawat
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
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Pendidikan</th>
                            <th>No HP</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($perawats as $perawat)
                        <tr>
                            <td>{{ $perawat->id_perawat }}</td>
                            <td>{{ $perawat->nama }}</td>
                            <td>{{ $perawat->email }}</td>
                            <td>{{ $perawat->pendidikan }}</td>
                            <td>{{ $perawat->no_hp }}</td>
                            <td>{{ $perawat->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.perawat.edit', $perawat->id_perawat) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.perawat.destroy', $perawat->id_perawat) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus perawat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data perawat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $perawats->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

