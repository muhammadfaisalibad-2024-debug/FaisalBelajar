<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pet;
use App\Models\User;
use App\Models\TemuDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $rekamMedis = DB::table('rekam_medis as rm')
            ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->join('pet', 'td.idpet', '=', 'pet.idpet')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('user as owner_user', 'pemilik.iduser', '=', 'owner_user.iduser')
            ->leftJoin('role_user as ru', 'rm.dokter_pemeriksa', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                'rm.*',
                'td.no_urut',
                'td.waktu_daftar',
                'pet.nama as pet_name',
                'owner_user.nama as owner_name',
                DB::raw("COALESCE(u.nama, '-') as dokter_name")
            )
            ->orderBy('rm.created_at', 'desc')
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
            $q->whereIn('role.idrole', [3, 2]); // Perawat atau Dokter
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

        $validated = $this->validateRekamMedis($request);

        // Get dokter idrole_user from temu_dokter directly
        $temuDokter = TemuDokter::findOrFail($validated['idreservasi_dokter']);
        $validated['dokter_pemeriksa'] = $temuDokter->idrole_user;
        $validated['created_at'] = now();

        $this->createRekamMedis($validated);

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

        $rekamMedis = RekamMedis::with(['temuDokter.pet.owner', 'dokter.user'])->findOrFail($id);
        
        return view('perawat.rekam-medis.edit', compact('rekamMedis'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $validated = $this->validateRekamMedis($request, $id);

        $rekamMedis = RekamMedis::findOrFail($id);
        
        // Only update anamnesa, temuan_klinis, diagnosa - dokter and reservasi should not change
        $rekamMedis->update([
            'anamnesa' => $validated['anamnesa'],
            'temuan_klinis' => $validated['temuan_klinis'] ?? null,
            'diagnosa' => $validated['diagnosa'] ?? null,
        ]);

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

    // Validation helper for Rekam Medis
    protected function validateRekamMedis(Request $request, $id = null)
    {
        return $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'nullable|string',
        ]);
    }

    protected function createRekamMedis(array $data)
    {
        try {
            return RekamMedis::create($data);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan rekam medis: ' . $e->getMessage());
        }
    }
}
