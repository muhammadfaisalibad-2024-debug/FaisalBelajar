@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('pemilik.rekam-medis') }}">Rekam Medis</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0"><i class="fas fa-file-medical text-primary"></i> Detail Rekam Medis</h5>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">Tanggal</th>
                            <td>: {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>No. Urut</th>
                            <td>: {{ $rekamMedis->no_urut }}</td>
                        </tr>
                        <tr>
                            <th>Nama Hewan</th>
                            <td>: <strong>{{ $rekamMedis->pet_name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>: {{ $rekamMedis->jenis_kelamin }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th width="150">Dokter Pemeriksa</th>
                            <td>: Dr. {{ $rekamMedis->dokter_name }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Daftar</th>
                            <td>: {{ \Carbon\Carbon::parse($rekamMedis->waktu_daftar)->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-12">
                    <h6 class="text-primary"><i class="fas fa-notes-medical"></i> Anamnesa</h6>
                    <p>{{ $rekamMedis->anamnesa }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <h6 class="text-primary"><i class="fas fa-stethoscope"></i> Temuan Klinis</h6>
                    <p>{{ $rekamMedis->temuan_klinis ?? '-' }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <h6 class="text-primary"><i class="fas fa-diagnoses"></i> Diagnosa</h6>
                    <p>{{ $rekamMedis->diagnosa }}</p>
                </div>
            </div>

            @if($details->count() > 0)
            <hr>
            <h6 class="text-primary mb-3"><i class="fas fa-prescription"></i> Detail Tindakan Terapi</h6>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Tindakan</th>
                            <th>Deskripsi Tindakan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($details as $index => $detail)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-info">{{ $detail->kode }}</span></td>
                            <td>{{ $detail->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $detail->detail ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('pemilik.rekam-medis') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
