@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dokter.detail-rekam.index') }}">Detail Rekam Medis</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0"><i class="fas fa-plus text-primary"></i> Tambah Detail Rekam Medis</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('dokter.detail-rekam.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Rekam Medis <span class="text-danger">*</span></label>
                    <select name="idrekam_medis" class="form-select @error('idrekam_medis') is-invalid @enderror" required>
                        <option value="">-- Pilih Rekam Medis --</option>
                        @foreach($rekamMedis as $rekam)
                            <option value="{{ $rekam->idrekam_medis }}" {{ old('idrekam_medis') == $rekam->idrekam_medis ? 'selected' : '' }}>
                                No. {{ $rekam->no_urut }} - {{ $rekam->pet_name }} ({{ \Carbon\Carbon::parse($rekam->created_at)->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                    @error('idrekam_medis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode Tindakan Terapi <span class="text-danger">*</span></label>
                    <select name="idkode_tindakan_terapi" class="form-select @error('idkode_tindakan_terapi') is-invalid @enderror" required>
                        <option value="">-- Pilih Tindakan Terapi --</option>
                        @foreach($therapyCodes as $code)
                            <option value="{{ $code->idkode_tindakan_terapi }}" {{ old('idkode_tindakan_terapi') == $code->idkode_tindakan_terapi ? 'selected' : '' }}>
                                {{ $code->kode }} - {{ $code->deskripsi_tindakan_terapi }}
                            </option>
                        @endforeach
                    </select>
                    @error('idkode_tindakan_terapi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Detail / Catatan</label>
                    <textarea name="detail" 
                              class="form-control @error('detail') is-invalid @enderror" 
                              rows="4" 
                              placeholder="Masukkan detail atau catatan tambahan...">{{ old('detail') }}</textarea>
                    @error('detail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('dokter.detail-rekam.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
