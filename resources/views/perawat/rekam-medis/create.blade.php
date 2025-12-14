@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2><i class="fas fa-plus-circle"></i> Tambah Rekam Medis</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('perawat.rekam-medis.index') }}">Rekam Medis</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="idreservasi_dokter" class="form-label">Pilih Reservasi <span class="text-danger">*</span></label>
                    <select name="idreservasi_dokter" id="idreservasi_dokter" class="form-select @error('idreservasi_dokter') is-invalid @enderror" required>
                        <option value="">-- Pilih Reservasi --</option>
                        @foreach($temuDokter as $temu)
                            <option value="{{ $temu->idreservasi_dokter }}" {{ old('idreservasi_dokter') == $temu->idreservasi_dokter ? 'selected' : '' }}>
                                No. {{ $temu->no_urut }} - {{ $temu->pet->nama ?? 'N/A' }} ({{ $temu->pet->owner->nama ?? 'N/A' }}) - {{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d/m/Y H:i') }}
                            </option>
                        @endforeach
                    </select>
                    @error('idreservasi_dokter')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dokter_pemeriksa" class="form-label">Dokter Pemeriksa <span class="text-danger">*</span></label>
                    <select name="dokter_pemeriksa" id="dokter_pemeriksa" class="form-select @error('dokter_pemeriksa') is-invalid @enderror" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->iduser }}" {{ old('dokter_pemeriksa', auth()->user()->iduser) == $user->iduser ? 'selected' : '' }}>
                                {{ $user->nama }}
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
                              required>{{ old('anamnesa') }}</textarea>
                    @error('anamnesa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                    <textarea name="temuan_klinis" id="temuan_klinis" rows="3" 
                              class="form-control @error('temuan_klinis') is-invalid @enderror">{{ old('temuan_klinis') }}</textarea>
                    @error('temuan_klinis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="diagnosa" class="form-label">Diagnosa</label>
                    <textarea name="diagnosa" id="diagnosa" rows="3" 
                              class="form-control @error('diagnosa') is-invalid @enderror">{{ old('diagnosa') }}</textarea>
                    @error('diagnosa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
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


