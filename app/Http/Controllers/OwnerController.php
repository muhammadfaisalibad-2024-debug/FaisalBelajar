<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    
    public function index()
    {
        $owners = Owner::with('pets')->orderBy('idpemilik', 'desc')->paginate(10);
        return view('admin.pemilik.index', compact('owners'));
    }

   
    public function create()
    {
        $users = \App\Models\User::all();
        return view('admin.pemilik.create', compact('users'));
    }

    
    public function store(Request $request)
    {
        $validated = $this->validateOwner($request);

        $this->createOwner($validated);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil ditambahkan.');
    }

    
    public function edit(Owner $pemilik)
    {
        $users = \App\Models\User::all();
        return view('admin.pemilik.edit', compact('pemilik', 'users'));
    }

   
    public function update(Request $request, Owner $pemilik)
    {
        $validated = $this->validateOwner($request, $pemilik->idpemilik);

        $pemilik->update($validated);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil diperbarui.');
    }

  
    public function destroy(Owner $pemilik)
    {
        $pemilik->delete();

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil dihapus.');
    }

    protected function validateOwner(Request $request, $id = null)
    {
        return $request->validate([
            'no_wa' => 'nullable|string|max:45',
            'alamat' => 'nullable|string|max:100',
            'iduser' => 'required|exists:user,iduser',
        ]);
    }

    protected function createOwner(array $data)
    {
        try {
            return Owner::create($data);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data pemilik: ' . $e->getMessage());
        }
    }
}

