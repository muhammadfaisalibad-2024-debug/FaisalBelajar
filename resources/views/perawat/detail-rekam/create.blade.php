@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2><i class="fas fa-plus-circle"></i> Tambah Detail Rekam Medis</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('perawat.detail-rekam.index') }}">Detail Rekam</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('perawat.detail-rekam.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="idrekam_medis" class="form-label">Rekam Medis <span class="text-danger">*</span></label>
                    <select name="idrekam_medis" id="idrekam_medis" class="form-select @error('idrekam_medis') is-invalid @enderror" required>
                        <option value="">-- Pilih Rekam Medis --</option>
                        @foreach($rekamMedis as $rm)
                            <option value="{{ $rm->idrekam_medis }}" {{ old('idrekam_medis') == $rm->idrekam_medis ? 'selected' : '' }}>
                                No. {{ $rm->temuDokter->no_urut }} - {{ date('d/m/Y H:i', strtotime($rm->created_at)) }} - {{ $rm->temuDokter->pet->nama ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                    @error('idrekam_medis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="idkode_tindakan_terapi" class="form-label">Tindakan Terapi <span class="text-danger">*</span></label>
                    <select name="idkode_tindakan_terapi" id="idkode_tindakan_terapi" class="form-select @error('idkode_tindakan_terapi') is-invalid @enderror" required>
                        <option value="">-- Pilih Tindakan --</option>
                        @foreach($therapyCodes as $code)
                            <option value="{{ $code->idkode_tindakan_terapi }}" {{ old('idkode_tindakan_terapi') == $code->idkode_tindakan_terapi ? 'selected' : '' }}>
                                {{ $code->kode }} - {{ $code->nama_tindakan }}
                            </option>
                        @endforeach
                    </select>
                    @error('idkode_tindakan_terapi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="detail" class="form-label">Detail Tindakan <span class="text-danger">*</span></label>
                    <textarea name="detail" id="detail" rows="4" 
                              class="form-control @error('detail') is-invalid @enderror" 
                              required>{{ old('detail') }}</textarea>
                    <small class="text-muted">Jelaskan detail tindakan yang dilakukan</small>
                    @error('detail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('perawat.detail-rekam.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
