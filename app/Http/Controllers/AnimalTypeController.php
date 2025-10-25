<?php

namespace App\Http\Controllers;

use App\Models\AnimalType;
use Illuminate\Http\Request;

class AnimalTypeController extends Controller
{
    public function index()
    {
        $animalTypes = AnimalType::withCount('breeds')->orderBy('idjenis_hewan', 'desc')->paginate(10);
        return view('admin.jenis-hewan.index', compact('animalTypes'));
    }

    public function create()
    {
        return view('admin.jenis-hewan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis_hewan',
        ]);

        AnimalType::create($validated);

        return redirect()->route('jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    public function edit(AnimalType $jenisHewan)
    {
        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    public function update(Request $request, AnimalType $jenisHewan)
    {
        $validated = $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis_hewan,' . $jenisHewan->idjenis_hewan . ',idjenis_hewan',
        ]);

        $jenisHewan->update($validated);

        return redirect()->route('jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil diperbarui.');
    }

    public function destroy(AnimalType $jenisHewan)
    {
        $jenisHewan->delete();

        return redirect()->route('jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil dihapus.');
    }
}
