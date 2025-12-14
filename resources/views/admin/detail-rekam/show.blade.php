@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Tindakan Terapi</h5>
                    <a href="{{ route('admin.detail-rekam.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">ID Detail</th>
                            <td>{{ $detail->iddetail_rekam_medis }}</td>
                        </tr>
                        <tr>
                            <th>ID Rekam Medis</th>
                            <td>#{{ $detail->idrekam_medis }}</td>
                        </tr>
                        <tr>
                            <th>Nama Hewan</th>
                            <td>{{ $detail->pet_name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Rekam Medis</th>
                            <td>{{ \Carbon\Carbon::parse($detail->tanggal_rekam)->format('d M Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Kode Tindakan</th>
                            <td><span class="badge bg-secondary">{{ $detail->kode }}</span></td>
                        </tr>
                        <tr>
                            <th>Deskripsi Tindakan</th>
                            <td>{{ $detail->deskripsi_tindakan_terapi }}</td>
                        </tr>
                        <tr>
                            <th>Detail</th>
                            <td>{{ $detail->detail ?? '-' }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="{{ route('admin.detail-rekam.edit', $detail->iddetail_rekam_medis) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('admin.detail-rekam.destroy', $detail->iddetail_rekam_medis) }}" 
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
