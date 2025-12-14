@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-users"></i> Data Pemilik</h2>
        <a href="{{ route('admin.pemilik.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pemilik
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
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>No WhatsApp</th>
                            <th>Alamat</th>
                            <th>Jumlah Pet</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($owners as $index => $owner)
                            <tr>
                                <td>{{ $owners->firstItem() + $index }}</td>
                                <td>{{ $owner->user->nama ?? '-' }}</td>
                                <td>{{ $owner->user->email ?? '-' }}</td>
                                <td>{{ $owner->no_wa ?? '-' }}</td>
                                <td>{{ $owner->alamat ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $owner->pets->count() }} Pet</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.pemilik.edit', $owner->idpemilik) }}" 
                                           class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pemilik.destroy', $owner->idpemilik) }}" 
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
                                <td colspan="7" class="text-center">Tidak ada data pemilik.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $owners->links() }}
            </div>
        </div>
    </div>
</div>
@endsection


