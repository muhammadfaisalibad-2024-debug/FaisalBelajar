@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Kode Tindakan Terapi</h1>
        <a href="{{ route('admin.kode-tindakan-terapi.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kode Tindakan
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
                            <th width="10%">Kode</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Kategori Klinis</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($therapyCodes as $index => $code)
                            <tr>
                                <td>{{ $therapyCodes->firstItem() + $index }}</td>
                                <td><strong>{{ $code->kode }}</strong></td>
                                <td>{{ $code->deskripsi_tindakan_terapi }}</td>
                                <td>{{ $code->category->nama_kategori ?? '-' }}</td>
                                <td>{{ $code->clinicalCategory->nama_kategori_klinis ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.kode-tindakan-terapi.edit', $code->idkode_tindakan_terapi) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.kode-tindakan-terapi.destroy', $code->idkode_tindakan_terapi) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                <td colspan="6" class="text-center">Tidak ada data kode tindakan terapi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $therapyCodes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

