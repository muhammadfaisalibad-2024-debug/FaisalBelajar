@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-4">
        <h2><i class="fas fa-paw"></i> Edit Hewan Peliharaan</h2>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pet <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama') ?? $pet->nama }}"
                                   placeholder="Masukkan nama pet"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idpemilik" class="form-label">Pemilik <span class="text-danger">*</span></label>
                            <select class="form-select @error('idpemilik') is-invalid @enderror" 
                                    id="idpemilik" 
                                    name="idpemilik" 
                                    required>
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach($owners as $owner)
                                    <option value="{{ $owner->idpemilik }}" 
                                        {{ (old('idpemilik') ?? $pet->idpemilik) == $owner->idpemilik ? 'selected' : '' }}>
                                        {{ $owner->user->nama ?? 'User tidak ditemukan' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpemilik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idjenis_hewan" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
                            <select class="form-select @error('idjenis_hewan') is-invalid @enderror" 
                                    id="idjenis_hewan" 
                                    name="idjenis_hewan" 
                                    required>
                                <option value="">-- Pilih Jenis Hewan --</option>
                                @foreach($animalTypes as $type)
                                    <option value="{{ $type->idjenis_hewan }}"
                                        {{ ($pet->animalBreed->idjenis_hewan ?? null) == $type->idjenis_hewan ? 'selected' : '' }}>
                                        {{ $type->nama_jenis_hewan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idjenis_hewan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idras_hewan" class="form-label">Ras <span class="text-danger">*</span></label>
                            <select class="form-select @error('idras_hewan') is-invalid @enderror" 
                                    id="idras_hewan" 
                                    name="idras_hewan" 
                                    required>
                                <option value="">-- Pilih Ras --</option>
                                @foreach($animalBreeds as $breed)
                                    <option value="{{ $breed->idras_hewan }}"
                                        {{ (old('idras_hewan') ?? $pet->idras_hewan) == $breed->idras_hewan ? 'selected' : '' }}>
                                        {{ $breed->nama_ras }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idras_hewan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                    id="jenis_kelamin" 
                                    name="jenis_kelamin" 
                                    required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L" {{ (old('jenis_kelamin') ?? $pet->jenis_kelamin) == 'L' ? 'selected' : '' }}>Jantan</option>
                                <option value="P" {{ (old('jenis_kelamin') ?? $pet->jenis_kelamin) == 'P' ? 'selected' : '' }}>Betina</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" 
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                   id="tanggal_lahir" 
                                   name="tanggal_lahir" 
                                   value="{{ old('tanggal_lahir') ?? ($pet->tanggal_lahir ? $pet->tanggal_lahir->format('Y-m-d') : '') }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="warna_tanda" class="form-label">Warna/Tanda Khusus</label>
                    <input type="text" 
                           class="form-control @error('warna_tanda') is-invalid @enderror" 
                           id="warna_tanda" 
                           name="warna_tanda" 
                           value="{{ old('warna_tanda') ?? $pet->warna_tanda }}"
                           placeholder="Contoh: Putih dengan bercak hitam di telinga kanan">
                    @error('warna_tanda')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('idjenis_hewan').addEventListener('change', function() {
    const jenisHewanId = this.value;
    const rasSelect = document.getElementById('idras_hewan');
    
    rasSelect.innerHTML = '<option value="">Loading...</option>';
    
    if (jenisHewanId) {
        fetch(`/api/breeds/${jenisHewanId}`)
            .then(response => response.json())
            .then(data => {
                rasSelect.innerHTML = '<option value="">-- Pilih Ras --</option>';
                data.forEach(breed => {
                    rasSelect.innerHTML += `<option value="${breed.idras_hewan}">${breed.nama_ras}</option>`;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                rasSelect.innerHTML = '<option value="">Error loading breeds</option>';
            });
    } else {
        rasSelect.innerHTML = '<option value="">-- Pilih Jenis Hewan Dulu --</option>';
    }
});
</script>
@endsection

