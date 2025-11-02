@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2><i class="fas fa-edit"></i> Edit Rekam Medis</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('perawat.rekam-medis.index') }}">Rekam Medis</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="idreservasi_dokter" class="form-label">Reservasi Dokter <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" value="No. {{ $rekamMedis->temuDokter->no_urut }} - {{ $rekamMedis->temuDokter->pet->nama }} ({{ $rekamMedis->temuDokter->pet->owner->nama }}) - {{ date('d/m/Y H:i', strtotime($rekamMedis->temuDokter->waktu_daftar)) }}" disabled>
                    <input type="hidden" name="idreservasi_dokter" value="{{ $rekamMedis->idreservasi_dokter }}">
                    <small class="text-muted">Reservasi tidak dapat diubah</small>
                </div>

                <div class="mb-3">
                    <label for="dokter_pemeriksa" class="form-label">Dokter Pemeriksa <span class="text-danger">*</span></label>
                    <select name="dokter_pemeriksa" id="dokter_pemeriksa" class="form-select @error('dokter_pemeriksa') is-invalid @enderror" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dokter)
                            <option value="{{ $dokter->iduser }}" {{ old('dokter_pemeriksa', $rekamMedis->dokter_pemeriksa) == $dokter->iduser ? 'selected' : '' }}>
                                {{ $dokter->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('dokter_pemeriksa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="anamnesa" class="form-label">Anamnesa <span class="text-danger">*</span></label>
                    <textarea name="anamnesa" id="anamnesa" rows="3" 
                              class="form-control @error('anamnesa') is-invalid @enderror" 
                              required>{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
                    @error('anamnesa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="temuan_klinis" class="form-label">Temuan Klinis <span class="text-danger">*</span></label>
                    <textarea name="temuan_klinis" id="temuan_klinis" rows="3" 
                              class="form-control @error('temuan_klinis') is-invalid @enderror" 
                              required>{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>
                    @error('temuan_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="diagnosa" class="form-label">Diagnosa <span class="text-danger">*</span></label>
                    <textarea name="diagnosa" id="diagnosa" rows="3" 
                              class="form-control @error('diagnosa') is-invalid @enderror" 
                              required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
                    @error('diagnosa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
