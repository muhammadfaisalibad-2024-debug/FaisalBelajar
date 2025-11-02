<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $hasResepsonisRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 4)->exists();
        
        if (!$hasResepsonisRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Resepsionis.');
        }

        $temuDokter = TemuDokter::with(['pet.owner', 'roleUser.user', 'roleUser.role'])
            ->orderBy('waktu_daftar', 'desc')
            ->paginate(10);
        return view('resepsionis.temu-dokter.index', compact('temuDokter'));
    }

    public function create()
    {
        $user = auth()->user();
        $hasResepsonisRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 4)->exists();
        
        if (!$hasResepsonisRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Resepsionis.');
        }

        $pets = Pet::with('owner')->orderBy('nama')->get();
        // Get role_user untuk dokter (idrole = 9)
        $dokters = \App\Models\RoleUser::with('user')
            ->where('idrole', 9)
            ->where('status', 1)
            ->get();
        
        return view('resepsionis.temu-dokter.create', compact('pets', 'dokters'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $hasResepsonisRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 4)->exists();
        
        if (!$hasResepsonisRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Resepsionis.');
        }

        $validated = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'status' => 'required|in:0,1,2,3', // 0=pending, 1=confirmed, 2=completed, 3=cancelled
        ]);

        // Get no_urut terakhir untuk hari ini
        $lastNoUrut = TemuDokter::whereDate('waktu_daftar', today())->max('no_urut') ?? 0;
        $validated['no_urut'] = $lastNoUrut + 1;
        $validated['waktu_daftar'] = now();

        TemuDokter::create($validated);

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Janji temu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $hasResepsonisRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 4)->exists();
        
        if (!$hasResepsonisRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Resepsionis.');
        }

        $temuDokter = TemuDokter::findOrFail($id);
        $pets = Pet::with('owner')->orderBy('nama')->get();
        $dokters = \App\Models\RoleUser::with('user')
            ->where('idrole', 9)
            ->where('status', 1)
            ->get();
        
        return view('resepsionis.temu-dokter.edit', compact('temuDokter', 'pets', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $hasResepsonisRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 4)->exists();
        
        if (!$hasResepsonisRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Resepsionis.');
        }

        $validated = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'status' => 'required|in:0,1,2,3',
        ]);

        $temuDokter = TemuDokter::findOrFail($id);
        $temuDokter->update($validated);

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Janji temu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $hasResepsonisRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 4)->exists();
        
        if (!$hasResepsonisRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Resepsionis.');
        }

        $temuDokter = TemuDokter::findOrFail($id);
        $temuDokter->delete();

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Janji temu berhasil dihapus.');
    }
}
