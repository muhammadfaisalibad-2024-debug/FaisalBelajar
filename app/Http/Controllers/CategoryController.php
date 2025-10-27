<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('idkategori', 'desc')->paginate(10);
        return view('admin.kategori.index', compact('categories'));
    }

 
    public function create()
    {
        return view('admin.kategori.create');
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        Category::create($validated);

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

   
    public function show(Category $kategori)
    {
        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit(Category $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    
    public function update(Request $request, Category $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:100',
        ]);

        $kategori->update($validated);

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }


    public function destroy(Category $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}
