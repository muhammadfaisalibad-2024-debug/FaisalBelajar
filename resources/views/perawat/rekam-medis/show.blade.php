@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2><i class="fas fa-file-medical"></i> Detail Rekam Medis</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('perawat.rekam-medis.index') }}">Rekam Medis</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informasi Rekam Medis</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">Tanggal Dibuat</th>
                            <td>{{ date('d F Y H:i', strtotime($rekamMedis->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>No. Urut Reservasi</th>
                            <td>{{ $rekamMedis->temuDokter->no_urut ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Daftar</th>
                            <td>{{ $rekamMedis->temuDokter ? date('d F Y H:i', strtotime($rekamMedis->temuDokter->waktu_daftar)) : '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pet</th>
                            <td>{{ $rekamMedis->temuDokter->pet->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Pemilik</th>
                            <td>{{ $rekamMedis->temuDokter->pet->owner->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Dokter Pemeriksa</th>
                            <td>{{ $rekamMedis->dokter->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Anamnesa</th>
                            <td>{{ $rekamMedis->anamnesa }}</td>
                        </tr>
                        <tr>
                            <th>Temuan Klinis</th>
                            <td>{{ $rekamMedis->temuan_klinis ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Diagnosa</th>
                            <td>{{ $rekamMedis->diagnosa ?? '-' }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('perawat.rekam-medis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Detail Tindakan</h5>
                </div>
                <div class="card-body">
                    @if($rekamMedis->details->count() > 0)
                        <div class="list-group">
                            @foreach($rekamMedis->details as $detail)
                            <div class="list-group-item">
                                <h6 class="mb-1">
                                    <span class="badge bg-secondary">{{ $detail->kodeTindakan->kode ?? 'N/A' }}</span>
                                    {{ $detail->kodeTindakan->nama_tindakan ?? 'N/A' }}
                                </h6>
                                <p class="mb-0 small text-muted">{{ $detail->detail ?? '-' }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center">Belum ada detail tindakan</p>
                        <a href="{{ route('perawat.detail-rekam.create', ['rekam_medis_id' => $rekamMedis->idrekam_medis]) }}" class="btn btn-sm btn-primary w-100">
                            <i class="fas fa-plus"></i> Tambah Detail Tindakan
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
