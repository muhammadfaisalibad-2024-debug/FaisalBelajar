@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tambah Detail Rekam Medis</h5>
                    <a href="{{ route('admin.detail-rekam.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.detail-rekam.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Rekam Medis <span class="text-danger">*</span></label>
                            <select name="idrekam_medis" class="form-select" required>
                                <option value="">-- Pilih Rekam Medis --</option>
                                @foreach($rekamMedis as $rm)
                                    <option value="{{ $rm->idrekam_medis }}" {{ old('idrekam_medis') == $rm->idrekam_medis ? 'selected' : '' }}>
                                        #{{ $rm->idrekam_medis }} - {{ $rm->pet_name }} - No. Urut: {{ $rm->no_urut }} ({{ \Carbon\Carbon::parse($rm->created_at)->format('d M Y') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Tindakan Terapi <span class="text-danger">*</span></label>
                            <select name="idkode_tindakan_terapi" class="form-select" required>
                                <option value="">-- Pilih Tindakan --</option>
                                @foreach($therapyCodes as $tc)
                                    <option value="{{ $tc->idkode_tindakan_terapi }}" {{ old('idkode_tindakan_terapi') == $tc->idkode_tindakan_terapi ? 'selected' : '' }}>
                                        {{ $tc->kode }} - {{ $tc->deskripsi_tindakan_terapi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="detail" class="form-label">Detail</label>
                            <textarea name="detail" id="detail" class="form-control" rows="4">{{ old('detail') }}</textarea>
                            <small class="text-muted">Catatan tambahan untuk tindakan ini (opsional)</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.detail-rekam.index') }}" class="btn btn-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
