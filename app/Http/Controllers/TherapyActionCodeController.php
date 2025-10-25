<?php

namespace App\Http\Controllers;

use App\Models\TherapyActionCode;
use App\Models\Category;
use App\Models\ClinicalCategory;
use Illuminate\Http\Request;

class TherapyActionCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $therapyCodes = TherapyActionCode::with(['category', 'clinicalCategory'])->orderBy('idkode_tindakan_terapi', 'desc')->paginate(10);
        return view('admin.kode-tindakan-terapi.index', compact('therapyCodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $clinicalCategories = ClinicalCategory::all();
        return view('admin.kode-tindakan-terapi.create', compact('categories', 'clinicalCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:5',
            'deskripsi_tindakan_terapi' => 'required|string|max:100',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        TherapyActionCode::create($validated);

        return redirect()->route('kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TherapyActionCode $kodeTindakanTerapi)
    {
        return view('admin.kode-tindakan-terapi.show', compact('kodeTindakanTerapi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TherapyActionCode $kodeTindakanTerapi)
    {
        $categories = Category::all();
        $clinicalCategories = ClinicalCategory::all();
        return view('admin.kode-tindakan-terapi.edit', compact('kodeTindakanTerapi', 'categories', 'clinicalCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TherapyActionCode $kodeTindakanTerapi)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:5',
            'deskripsi_tindakan_terapi' => 'required|string|max:100',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        $kodeTindakanTerapi->update($validated);

        return redirect()->route('kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TherapyActionCode $kodeTindakanTerapi)
    {
        $kodeTindakanTerapi->delete();

        return redirect()->route('kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil dihapus.');
    }
}
