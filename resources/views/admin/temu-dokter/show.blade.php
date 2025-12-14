@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Temu Dokter #{{ $temuDokter->no_urut }}</h5>
                    <a href="{{ route('admin.temu-dokter.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Informasi Reservasi</h6>
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%">ID Reservasi</th>
                                    <td>{{ $temuDokter->idreservasi_dokter }}</td>
                                </tr>
                                <tr>
                                    <th>No. Urut</th>
                                    <td><span class="badge bg-primary">{{ $temuDokter->no_urut }}</span></td>
                                </tr>
                                <tr>
                                    <th>Waktu Daftar</th>
                                    <td>{{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($temuDokter->status == 1)
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($temuDokter->status == 2)
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Batal</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Informasi Pasien</h6>
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%">Nama Hewan</th>
                                    <td>{{ $temuDokter->pet_name }}</td>
                                </tr>
                                <tr>
                                    <th>Pemilik</th>
                                    <td>{{ $temuDokter->owner_name }}</td>
                                </tr>
                                <tr>
                                    <th>No. WhatsApp</th>
                                    <td>{{ $temuDokter->owner_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Dokter</th>
                                    <td>{{ $temuDokter->dokter_name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.temu-dokter.edit', $temuDokter->idreservasi_dokter) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.temu-dokter.destroy', $temuDokter->idreservasi_dokter) }}" 
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
