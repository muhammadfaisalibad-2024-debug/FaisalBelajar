@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h2><i class="fas fa-edit"></i> Edit Janji Temu</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('resepsionis.temu-dokter.index') }}">Temu Dokter</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('resepsionis.temu-dokter.update', $temuDokter->idreservasi_dokter) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">No. Urut</label>
                    <input type="text" class="form-control" value="{{ $temuDokter->no_urut }}" disabled>
                    <small class="text-muted">No. urut tidak dapat diubah</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu Daftar</label>
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('d/m/Y H:i') }}" disabled>
                    <small class="text-muted">Waktu daftar tidak dapat diubah</small>
                </div>

                <div class="mb-3">
                    <label for="idpet" class="form-label">Pet <span class="text-danger">*</span></label>
                    <select name="idpet" id="idpet" class="form-select @error('idpet') is-invalid @enderror" required>
                        <option value="">-- Pilih Pet --</option>
                        @foreach($pets as $pet)
                            <option value="{{ $pet->idpet }}" {{ old('idpet', $temuDokter->idpet) == $pet->idpet ? 'selected' : '' }}>
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
                            <option value="{{ $roleUser->idrole_user }}" {{ old('idrole_user', $temuDokter->idrole_user) == $roleUser->idrole_user ? 'selected' : '' }}>
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
                        <option value="0" {{ old('status', $temuDokter->status) == '0' ? 'selected' : '' }}>Pending</option>
                        <option value="1" {{ old('status', $temuDokter->status) == '1' ? 'selected' : '' }}>Confirmed</option>
                        <option value="2" {{ old('status', $temuDokter->status) == '2' ? 'selected' : '' }}>Completed</option>
                        <option value="3" {{ old('status', $temuDokter->status) == '3' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
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


