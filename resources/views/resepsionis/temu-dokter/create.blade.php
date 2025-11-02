@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2><i class="fas fa-plus-circle"></i> Tambah Janji Temu</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('resepsionis.temu-dokter.index') }}">Temu Dokter</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="idpet" class="form-label">Pet <span class="text-danger">*</span></label>
                    <select name="idpet" id="idpet" class="form-select @error('idpet') is-invalid @enderror" required>
                        <option value="">-- Pilih Pet --</option>
                        @foreach($pets as $pet)
                            <option value="{{ $pet->idpet }}" {{ old('idpet') == $pet->idpet ? 'selected' : '' }}>
                                {{ $pet->nama }} - {{ $pet->owner->nama ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                    @error('idpet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="idrole_user" class="form-label">Dokter <span class="text-danger">*</span></label>
                    <select name="idrole_user" id="idrole_user" class="form-select @error('idrole_user') is-invalid @enderror" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $roleUser)
                            <option value="{{ $roleUser->idrole_user }}" {{ old('idrole_user') == $roleUser->idrole_user ? 'selected' : '' }}>
                                {{ $roleUser->user->nama }} - {{ $roleUser->role->nama_role ?? 'Dokter' }}
                            </option>
                        @endforeach
                    </select>
                    @error('idrole_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="0" {{ old('status', '0') == '0' ? 'selected' : '' }}>Pending</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Confirmed</option>
                        <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Completed</option>
                        <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Info:</strong> No. urut dan waktu daftar akan otomatis dibuat oleh sistem.
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
