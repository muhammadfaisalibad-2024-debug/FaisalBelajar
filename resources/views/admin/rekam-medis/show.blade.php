@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Rekam Medis #{{ $rekamMedis->idrekam_medis }}</h5>
                    <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Informasi Pemeriksaan</h6>
                            <table class="table table-sm">
                                <tr>
                                    <th width="40%">ID Rekam Medis</th>
                                    <td>{{ $rekamMedis->idrekam_medis }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>No. Urut</th>
                                    <td><span class="badge bg-primary">{{ $rekamMedis->no_urut }}</span></td>
                                </tr>
                                <tr>
                                    <th>Nama Hewan</th>
                                    <td>{{ $rekamMedis->pet_name }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $rekamMedis->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <th>Dokter Pemeriksa</th>
                                    <td>{{ $rekamMedis->dokter_name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3">Hasil Pemeriksaan</h6>
                            <div class="mb-3">
                                <strong>Anamnesa:</strong>
                                <p class="mt-2">{{ $rekamMedis->anamnesa }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Temuan Klinis:</strong>
                                <p class="mt-2">{{ $rekamMedis->temuan_klinis ?? '-' }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Diagnosa:</strong>
                                <p class="mt-2">{{ $rekamMedis->diagnosa }}</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h6 class="text-muted mb-3">Detail Tindakan & Terapi</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Deskripsi Tindakan</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($details as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="badge bg-secondary">{{ $detail->kode }}</span></td>
                                    <td>{{ $detail->deskripsi_tindakan_terapi }}</td>
                                    <td>{{ $detail->detail ?? '-' }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Belum ada detail tindakan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('admin.rekam-medis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.rekam-medis.destroy', $rekamMedis->idrekam_medis) }}" 
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
