<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    
    public function index()
    {
        $roles = Role::withCount('users')->orderBy('idrole', 'desc')->paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    
    public function create()
    {
        return view('admin.role.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_role' => 'required|string|max:100',
        ]);

        Role::create($validated);

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil ditambahkan.');
    }

    
    public function show(Role $role)
    {
        $role->load('users');
        return view('admin.role.show', compact('role'));
    }

    
    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }

   
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'nama_role' => 'required|string|max:100',
        ]);

        $role->update($validated);

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil diperbarui.');
    }
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('admin.role.index')
                         ->with('success', 'Role berhasil dihapus.');
    }
}

