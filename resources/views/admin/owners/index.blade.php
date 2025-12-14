@extends('layouts.app')

@section('title', 'Data Pemilik - RSHP')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-person"></i> Data Pemilik</h2>
            <a href="{{ route('owners.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Pemilik
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Alamat</th>
                                <th>Jumlah Hewan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($owners as $index => $owner)
                                <tr>
                                    <td>{{ $owners->firstItem() + $index }}</td>
                                    <td>
                                        <strong>{{ $owner->name }}</strong>
                                        @if($owner->identity_number)
                                            <br><small class="text-muted">NIK: {{ $owner->identity_number }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $owner->email ?? '-' }}</td>
                                    <td>{{ $owner->phone ?? '-' }}</td>
                                    <td>
                                        {{ Str::limit($owner->address ?? '-', 50) }}
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $owner->pets->count() }} hewan</span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('owners.edit', $owner) }}" 
                                               class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('owners.destroy', $owner) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                        Belum ada data pemilik
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($owners->hasPages())
                    <div class="mt-3">
                        {{ $owners->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

