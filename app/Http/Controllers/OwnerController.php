<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of owners.
     */
    public function index()
    {
        $owners = Owner::with('pets')->orderBy('idpemilik', 'desc')->paginate(10);
        return view('admin.pemilik.index', compact('owners'));
    }

    /**
     * Show the form for creating a new owner.
     */
    public function create()
    {
        $users = \App\Models\User::all();
        return view('admin.pemilik.create', compact('users'));
    }

    /**
     * Store a newly created owner.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_wa' => 'nullable|string|max:45',
            'alamat' => 'nullable|string|max:100',
            'iduser' => 'required|exists:user,iduser',
        ]);

        Owner::create($validated);

        return redirect()->route('pemilik.index')
            ->with('success', 'Data pemilik berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the owner.
     */
    public function edit(Owner $pemilik)
    {
        $users = \App\Models\User::all();
        return view('admin.pemilik.edit', compact('pemilik', 'users'));
    }

    /**
     * Update the specified owner.
     */
    public function update(Request $request, Owner $pemilik)
    {
        $validated = $request->validate([
            'no_wa' => 'nullable|string|max:45',
            'alamat' => 'nullable|string|max:100',
            'iduser' => 'required|exists:user,iduser',
        ]);

        $pemilik->update($validated);

        return redirect()->route('pemilik.index')
            ->with('success', 'Data pemilik berhasil diperbarui.');
    }

    /**
     * Remove the specified owner.
     */
    public function destroy(Owner $pemilik)
    {
        $pemilik->delete();

        return redirect()->route('pemilik.index')
            ->with('success', 'Data pemilik berhasil dihapus.');
    }
}
