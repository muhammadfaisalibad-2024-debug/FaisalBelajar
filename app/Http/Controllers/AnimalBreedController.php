<?php

namespace App\Http\Controllers;

use App\Models\AnimalBreed;
use App\Models\AnimalType;
use Illuminate\Http\Request;

class AnimalBreedController extends Controller
{
    public function index()
    {
        $breeds = AnimalBreed::with('animalType')->orderBy('idras_hewan', 'desc')->paginate(10);
        return view('admin.ras-hewan.index', compact('breeds'));
    }

    public function create()
    {
        $jenisHewan = AnimalType::all();
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        AnimalBreed::create($validated);

        return redirect()->route('ras-hewan.index')
                         ->with('success', 'Ras hewan berhasil ditambahkan.');
    }


    public function show(AnimalBreed $rasHewan)
    {
        return view('admin.ras-hewan.show', compact('rasHewan'));
    }

    public function edit(AnimalBreed $rasHewan)
    {
        $jenisHewan = AnimalType::all();
        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
    }


    public function update(Request $request, AnimalBreed $rasHewan)
    {
        $validated = $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        $rasHewan->update($validated);

        return redirect()->route('ras-hewan.index')
                         ->with('success', 'Ras hewan berhasil diperbarui.');
    }

   
    public function destroy(AnimalBreed $rasHewan)
    {
        $rasHewan->delete();

        return redirect()->route('ras-hewan.index')
                         ->with('success', 'Ras hewan berhasil dihapus.');
    }
}
