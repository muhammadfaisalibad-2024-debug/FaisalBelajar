@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Ras Hewan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="idjenis_hewan" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
                    <select class="form-select @error('idjenis_hewan') is-invalid @enderror" 
                            id="idjenis_hewan" name="idjenis_hewan" required>
                        <option value="">-- Pilih Jenis Hewan --</option>
                        @foreach($jenisHewan as $jenis)
                            <option value="{{ $jenis->idjenis_hewan }}" 
                                {{ old('idjenis_hewan', $rasHewan->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>
                    @error('idjenis_hewan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_ras" class="form-label">Nama Ras <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_ras') is-invalid @enderror" 
                           id="nama_ras" name="nama_ras" 
                           value="{{ old('nama_ras', $rasHewan->nama_ras) }}" required>
                    @error('nama_ras')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('ras-hewan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
