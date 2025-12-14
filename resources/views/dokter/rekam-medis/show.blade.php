@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2><i class="fas fa-file-medical"></i> Detail Rekam Medis</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dokter.rekam-medis.index') }}">Rekam Medis</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Informasi Rekam Medis</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="200">Tanggal Dibuat</th>
                            <td>{{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>No. Urut Reservasi</th>
                            <td><span class="badge bg-secondary">{{ $rekamMedis->no_urut ?? '-' }}</span></td>
                        </tr>
                        <tr>
                            <th>Waktu Daftar</th>
                            <td>{{ \Carbon\Carbon::parse($rekamMedis->waktu_daftar)->format('d F Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pet</th>
                            <td><strong>{{ $rekamMedis->pet_name ?? '-' }}</strong></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin Pet</th>
                            <td>{{ $rekamMedis->pet_gender ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Pemilik</th>
                            <td>{{ $rekamMedis->owner_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Dokter Pemeriksa</th>
                            <td>Dr. {{ $rekamMedis->dokter_name ?? '-' }}</td>
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
                        <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary">
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
                    @if($details && count($details) > 0)
                        <div class="list-group">
                            @foreach($details as $detail)
                            <div class="list-group-item">
                                <h6 class="mb-1">
                                    <span class="badge bg-secondary">{{ $detail->kode ?? 'N/A' }}</span>
                                    {{ $detail->deskripsi_tindakan_terapi ?? 'N/A' }}
                                </h6>
                                <p class="mb-0 small text-muted">{{ $detail->detail ?? '-' }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center">Belum ada detail tindakan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


