@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tambah Rekam Medis</h5>
                    <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary btn-sm">
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

                    <form action="{{ route('admin.rekam-medis.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Temu Dokter <span class="text-danger">*</span></label>
                            <select name="idreservasi_dokter" class="form-select" required>
                                <option value="">-- Pilih Temu Dokter --</option>
                                @foreach($temuDokter as $td)
                                    <option value="{{ $td->idreservasi_dokter }}" {{ old('idreservasi_dokter') == $td->idreservasi_dokter ? 'selected' : '' }}>
                                        No. {{ $td->no_urut }} - {{ $td->pet_name }} - Dr. {{ $td->dokter_name }} ({{ \Carbon\Carbon::parse($td->waktu_daftar)->format('d M Y H:i') }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="anamnesa" class="form-label">Anamnesa <span class="text-danger">*</span></label>
                            <textarea name="anamnesa" id="anamnesa" class="form-control" rows="3" required>{{ old('anamnesa') }}</textarea>
                            <small class="text-muted">Keluhan dan riwayat penyakit dari pemilik</small>
                        </div>

                        <div class="mb-3">
                            <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                            <textarea name="temuan_klinis" id="temuan_klinis" class="form-control" rows="3">{{ old('temuan_klinis') }}</textarea>
                            <small class="text-muted">Hasil pemeriksaan fisik dan klinis</small>
                        </div>

                        <div class="mb-3">
                            <label for="diagnosa" class="form-label">Diagnosa <span class="text-danger">*</span></label>
                            <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3" required>{{ old('diagnosa') }}</textarea>
                            <small class="text-muted">Kesimpulan diagnosa penyakit</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                            <a href="{{ route('admin.rekam-medis.index') }}" class="btn btn-secondary">
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
