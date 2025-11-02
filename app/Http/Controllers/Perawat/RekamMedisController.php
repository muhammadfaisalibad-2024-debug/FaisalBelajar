<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pet;
use App\Models\User;
use App\Models\TemuDokter;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $rekamMedis = RekamMedis::with(['dokter', 'temuDokter.pet.owner'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('perawat.rekam-medis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $temuDokter = TemuDokter::with('pet.owner')
            ->whereDoesntHave('rekamMedis') // Hanya reservasi yang belum ada rekam medis
            ->orderBy('waktu_daftar', 'desc')
            ->get();
        $users = User::whereHas('roles', function($q) {
            $q->whereIn('idrole', [3, 9]); // Perawat atau Dokter
        })->orderBy('nama')->get();
        
        return view('perawat.rekam-medis.create', compact('temuDokter', 'users'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $validated = $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'dokter_pemeriksa' => 'required|exists:user,iduser',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
        ]);

        $validated['created_at'] = now();

        RekamMedis::create($validated);

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $rekamMedis = RekamMedis::with(['dokter', 'temuDokter.pet.owner', 'details.kodeTindakan'])
            ->findOrFail($id);
        return view('perawat.rekam-medis.show', compact('rekamMedis'));
    }

    public function edit($id)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $rekamMedis = RekamMedis::with(['temuDokter.pet.owner', 'dokter'])->findOrFail($id);
        $dokters = User::whereHas('roles', function($q) {
            $q->where('role.idrole', 9)->where('status', 1);
        })->orderBy('nama')->get();
        
        return view('perawat.rekam-medis.edit', compact('rekamMedis', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $validated = $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'dokter_pemeriksa' => 'required|exists:user,iduser',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update($validated);

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->delete();

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil dihapus.');
    }
}
