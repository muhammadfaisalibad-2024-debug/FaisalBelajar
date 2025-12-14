@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-check"></i> Temu Dokter</h2>
        <a href="{{ route('admin.temu-dokter.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Temu Dokter
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No. Urut</th>
                            <th>Waktu Daftar</th>
                            <th>Hewan</th>
                            <th>Pemilik</th>
                            <th>Dokter</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($temuDokter as $index => $td)
                        <tr>
                            <td>{{ $temuDokter->firstItem() + $index }}</td>
                            <td><span class="badge bg-primary">{{ $td->no_urut }}</span></td>
                            <td>{{ $td->waktu_daftar ? \Carbon\Carbon::parse($td->waktu_daftar)->format('d/m/Y H:i') : '-' }}</td>
                            <td>{{ $td->pet_name }}</td>
                            <td>{{ $td->owner_name }}</td>
                            <td>{{ $td->dokter_name }}</td>
                            <td>
                                @if($td->status == 1)
                                    <span class="badge bg-warning">Menunggu</span>
                                @elseif($td->status == 2)
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-secondary">Dibatalkan</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.temu-dokter.show', $td->idreservasi_dokter) }}" 
                                       class="btn btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.temu-dokter.edit', $td->idreservasi_dokter) }}" 
                                       class="btn btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.temu-dokter.destroy', $td->idreservasi_dokter) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada data temu dokter</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $temuDokter->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
