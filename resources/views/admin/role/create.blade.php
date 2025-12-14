@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Role</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_role" class="form-label">Nama Role <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_role') is-invalid @enderror" 
                           id="nama_role" name="nama_role" value="{{ old('nama_role') }}" required>
                    @error('nama_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

