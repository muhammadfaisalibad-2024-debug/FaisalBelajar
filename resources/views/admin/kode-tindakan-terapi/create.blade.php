@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Kode Tindakan Terapi</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode') is-invalid @enderror" 
                                   id="kode" name="kode" value="{{ old('kode') }}" maxlength="5" required>
                            @error('kode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idkategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('idkategori') is-invalid @enderror" 
                                    id="idkategori" name="idkategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->idkategori }}" {{ old('idkategori') == $category->idkategori ? 'selected' : '' }}>
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idkategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="deskripsi_tindakan_terapi" class="form-label">Deskripsi Tindakan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" 
                                   id="deskripsi_tindakan_terapi" name="deskripsi_tindakan_terapi" 
                                   value="{{ old('deskripsi_tindakan_terapi') }}" maxlength="100" required>
                            @error('deskripsi_tindakan_terapi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idkategori_klinis" class="form-label">Kategori Klinis <span class="text-danger">*</span></label>
                            <select class="form-select @error('idkategori_klinis') is-invalid @enderror" 
                                    id="idkategori_klinis" name="idkategori_klinis" required>
                                <option value="">-- Pilih Kategori Klinis --</option>
                                @foreach($clinicalCategories as $clinical)
                                    <option value="{{ $clinical->idkategori_klinis }}" {{ old('idkategori_klinis') == $clinical->idkategori_klinis ? 'selected' : '' }}>
                                        {{ $clinical->nama_kategori_klinis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idkategori_klinis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">
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

