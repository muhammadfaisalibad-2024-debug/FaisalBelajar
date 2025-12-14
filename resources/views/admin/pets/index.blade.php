@extends('layouts.app')

@section('title', 'Data Hewan Peliharaan - RSHP')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-heart"></i> Data Hewan Peliharaan</h2>
            <a href="{{ route('pets.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Hewan
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Hewan</th>
                                <th>Jenis/Ras</th>
                                <th>Pemilik</th>
                                <th>Jenis Kelamin</th>
                                <th>Umur</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pets as $index => $pet)
                                <tr>
                                    <td>{{ $pets->firstItem() + $index }}</td>
                                    <td>
                                        @if($pet->photo)
                                            <img src="{{ Storage::url($pet->photo) }}" 
                                                 alt="{{ $pet->name }}" 
                                                 class="rounded" 
                                                 style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 50px; height: 50px;">
                                                <i class="bi bi-image text-white"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $pet->name }}</strong>
                                        @if($pet->color)
                                            <br><small class="text-muted">Warna: {{ $pet->color }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $pet->animalType->name }}
                                        @if($pet->animalBreed)
                                            <br><small class="text-muted">{{ $pet->animalBreed->name }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $pet->owner->name }}</td>
                                    <td>
                                        @if($pet->gender === 'male')
                                            <span class="badge bg-primary">
                                                <i class="bi bi-gender-male"></i> Jantan
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-gender-female"></i> Betina
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($pet->birth_date)
                                            {{ $pet->age }} tahun
                                            <br><small class="text-muted">{{ $pet->birth_date->format('d/m/Y') }}</small>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pets.edit', $pet) }}" 
                                               class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('pets.destroy', $pet) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        <i class="bi bi-inbox display-4 d-block mb-2"></i>
                                        Belum ada data hewan peliharaan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pets->hasPages())
                    <div class="mt-3">
                        {{ $pets->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

