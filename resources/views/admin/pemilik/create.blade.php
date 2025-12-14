@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-user-plus"></i> Tambah Pemilik</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pemilik.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="iduser" class="form-label">User <span class="text-danger">*</span></label>
                    <select class="form-select @error('iduser') is-invalid @enderror" 
                            id="iduser" 
                            name="iduser" 
                            required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                {{ $user->nama }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="no_wa" class="form-label">No WhatsApp</label>
                    <input type="text" 
                           class="form-control @error('no_wa') is-invalid @enderror" 
                           id="no_wa" 
                           name="no_wa" 
                           value="{{ old('no_wa') }}"
                           placeholder="Contoh: 081234567890">
                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror" 
                              id="alamat" 
                              name="alamat" 
                              rows="3"
                              placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


