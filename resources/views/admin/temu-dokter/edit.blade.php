@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="bi bi-calendar-check"></i> Edit Temu Dokter</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.temu-dokter.index') }}">Temu Dokter</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.temu-dokter.update', $temuDokter->idreservasi_dokter) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="idpet" class="form-label">Hewan Peliharaan <span class="text-danger">*</span></label>
                        <select class="form-select @error('idpet') is-invalid @enderror" id="idpet" name="idpet" required>
                            <option value="">Pilih Hewan</option>
                            @foreach($pets as $pet)
                                <option value="{{ $pet->idpet }}" {{ (old('idpet', $temuDokter->idpet) == $pet->idpet) ? 'selected' : '' }}>
                                    {{ $pet->pet_name }} - {{ $pet->owner_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('idpet')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="idrole_user" class="form-label">Dokter <span class="text-danger">*</span></label>
                        <select class="form-select @error('idrole_user') is-invalid @enderror" id="idrole_user" name="idrole_user" required>
                            <option value="">Pilih Dokter</option>
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->idrole_user }}" {{ (old('idrole_user', $temuDokter->idrole_user) == $dokter->idrole_user) ? 'selected' : '' }}>
                                    Dr. {{ $dokter->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('idrole_user')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="waktu_daftar" class="form-label">Waktu Daftar <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control @error('waktu_daftar') is-invalid @enderror" 
                               id="waktu_daftar" name="waktu_daftar" 
                               value="{{ old('waktu_daftar', isset($temuDokter->waktu_daftar) && $temuDokter->waktu_daftar ? \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('Y-m-d\TH:i') : '') }}" required>
                        @error('waktu_daftar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="1" {{ old('status', $temuDokter->status) == '1' ? 'selected' : '' }}>Menunggu</option>
                            <option value="2" {{ old('status', $temuDokter->status) == '2' ? 'selected' : '' }}>Selesai</option>
                            <option value="3" {{ old('status', $temuDokter->status) == '3' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.temu-dokter.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
