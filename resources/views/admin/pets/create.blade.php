@extends('layouts.app')

@section('title', 'Tambah Hewan Peliharaan - RSHP')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-heart-fill"></i> Tambah Hewan Peliharaan</h2>
            <a href="{{ route('pets.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('pets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="owner_id" class="form-label">Pemilik <span class="text-danger">*</span></label>
                        <select class="form-select @error('owner_id') is-invalid @enderror" 
                                id="owner_id" 
                                name="owner_id" 
                                required>
                            <option value="">Pilih Pemilik</option>
                            @foreach($owners as $owner)
                                <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>
                                    {{ $owner->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('owner_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Hewan <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="animal_type_id" class="form-label">Jenis Hewan <span class="text-danger">*</span></label>
                            <select class="form-select @error('animal_type_id') is-invalid @enderror" 
                                    id="animal_type_id" 
                                    name="animal_type_id" 
                                    required>
                                <option value="">Pilih Jenis Hewan</option>
                                @foreach($animalTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('animal_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('animal_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="animal_breed_id" class="form-label">Ras Hewan</label>
                            <select class="form-select @error('animal_breed_id') is-invalid @enderror" 
                                    id="animal_breed_id" 
                                    name="animal_breed_id">
                                <option value="">Pilih Ras (Opsional)</option>
                            </select>
                            @error('animal_breed_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-select @error('gender') is-invalid @enderror" 
                                    id="gender" 
                                    name="gender" 
                                    required>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Jantan</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Betina</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="birth_date" class="form-label">Tanggal Lahir</label>
                            <input type="date" 
                                   class="form-control @error('birth_date') is-invalid @enderror" 
                                   id="birth_date" 
                                   name="birth_date" 
                                   value="{{ old('birth_date') }}">
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="color" class="form-label">Warna</label>
                            <input type="text" 
                                   class="form-control @error('color') is-invalid @enderror" 
                                   id="color" 
                                   name="color" 
                                   value="{{ old('color') }}"
                                   placeholder="Contoh: Coklat, Hitam Putih">
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="weight" class="form-label">Berat (kg)</label>
                            <input type="number" 
                                   step="0.01"
                                   class="form-control @error('weight') is-invalid @enderror" 
                                   id="weight" 
                                   name="weight" 
                                   value="{{ old('weight') }}"
                                   placeholder="Contoh: 5.5">
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Hewan</label>
                        <input type="file" 
                               class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" 
                               name="photo"
                               accept="image/*">
                        <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="special_notes" class="form-label">Catatan Khusus</label>
                        <textarea class="form-control @error('special_notes') is-invalid @enderror" 
                                  id="special_notes" 
                                  name="special_notes" 
                                  rows="3"
                                  placeholder="Contoh: Alergi makanan tertentu, penyakit bawaan, dll">{{ old('special_notes') }}</textarea>
                        @error('special_notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Data
                        </button>
                        <a href="{{ route('pets.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('animal_type_id').addEventListener('change', function() {
        const typeId = this.value;
        const breedSelect = document.getElementById('animal_breed_id');
        
        breedSelect.innerHTML = '<option value="">Loading...</option>';
        
        if(typeId) {
            fetch(`/pets/breeds/${typeId}`)
                .then(response => response.json())
                .then(data => {
                    breedSelect.innerHTML = '<option value="">Pilih Ras (Opsional)</option>';
                    data.forEach(breed => {
                        const option = document.createElement('option');
                        option.value = breed.id;
                        option.textContent = breed.name;
                        breedSelect.appendChild(option);
                    });
                });
        } else {
            breedSelect.innerHTML = '<option value="">Pilih Ras (Opsional)</option>';
        }
    });
</script>
@endpush
