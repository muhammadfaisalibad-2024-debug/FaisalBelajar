<?php

namespace App\Http\Controllers;

use App\Models\TherapyActionCode;
use App\Models\Category;
use App\Models\ClinicalCategory;
use Illuminate\Http\Request;

class TherapyActionCodeController extends Controller
{
  
    public function index()
    {
        $therapyCodes = TherapyActionCode::with(['category', 'clinicalCategory'])->orderBy('idkode_tindakan_terapi', 'desc')->paginate(10);
        return view('admin.kode-tindakan-terapi.index', compact('therapyCodes'));
    }

    
    public function create()
    {
        $categories = Category::all();
        $clinicalCategories = ClinicalCategory::all();
        return view('admin.kode-tindakan-terapi.create', compact('categories', 'clinicalCategories'));
    }

    
    public function store(Request $request)
    {
        $validated = $this->validateTherapyCode($request);

        $this->createTherapyCode($validated);

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TherapyActionCode $kodeTindakanTerapi)
    {
        return view('admin.kode-tindakan-terapi.show', compact('kodeTindakanTerapi'));
    }

    
    public function edit(TherapyActionCode $kodeTindakanTerapi)
    {
        $categories = Category::all();
        $clinicalCategories = ClinicalCategory::all();
        return view('admin.kode-tindakan-terapi.edit', compact('kodeTindakanTerapi', 'categories', 'clinicalCategories'));
    }

   
    public function update(Request $request, TherapyActionCode $kodeTindakanTerapi)
    {
        $validated = $this->validateTherapyCode($request, $kodeTindakanTerapi->idkode_tindakan_terapi);

        $kodeTindakanTerapi->update($validated);

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil diperbarui.');
    }

   
    public function destroy(TherapyActionCode $kodeTindakanTerapi)
    {
        $kodeTindakanTerapi->delete();

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil dihapus.');
    }

    // Validation helper for therapy action codes
    protected function validateTherapyCode(Request $request, $id = null)
    {
        return $request->validate([
            'kode' => 'required|string|max:5',
            'deskripsi_tindakan_terapi' => 'required|string|max:100',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);
    }

    protected function createTherapyCode(array $data)
    {
        try {
            return TherapyActionCode::create($data);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan kode tindakan terapi: ' . $e->getMessage());
        }
    }
}

