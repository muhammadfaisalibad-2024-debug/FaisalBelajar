<?php

namespace App\Http\Controllers;

use App\Models\ClinicalCategory;
use Illuminate\Http\Request;

class ClinicalCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinicalCategories = ClinicalCategory::orderBy('idkategori_klinis', 'desc')->paginate(10);
        return view('admin.kategori-klinis.index', compact('clinicalCategories'));
    }

    public function create()
    {
        return view('admin.kategori-klinis.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori_klinis' => 'required|string|max:50',
        ]);

        ClinicalCategory::create($validated);

        return redirect()->route('admin.kategori-klinis.index')
                         ->with('success', 'Kategori klinis berhasil ditambahkan.');
    }


    public function show(ClinicalCategory $kategoriKlinis)
    {
        return view('admin.kategori-klinis.show', compact('kategoriKlinis'));
    }

    
    public function edit(ClinicalCategory $kategoriKlinis)
    {
        return view('admin.kategori-klinis.edit', compact('kategoriKlinis'));
    }

   
    public function update(Request $request, ClinicalCategory $kategoriKlinis)
    {
        $validated = $request->validate([
            'nama_kategori_klinis' => 'required|string|max:50',
        ]);

        $kategoriKlinis->update($validated);

        return redirect()->route('admin.kategori-klinis.index')
                         ->with('success', 'Kategori klinis berhasil diperbarui.');
    }


    public function destroy(ClinicalCategory $kategoriKlinis)
    {
        $kategoriKlinis->delete();

        return redirect()->route('admin.kategori-klinis.index')
                         ->with('success', 'Kategori klinis berhasil dihapus.');
    }
}

