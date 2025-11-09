<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\DetailRekamMedis;
use App\Models\RekamMedis;
use App\Models\TherapyActionCode;
use Illuminate\Http\Request;

class DetailRekamController extends Controller
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

        $detailRekam = DetailRekamMedis::with(['rekamMedis.temuDokter.pet', 'kodeTindakan'])->paginate(10);
        return view('perawat.detail-rekam.index', compact('detailRekam'));
    }

    public function create()
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $rekamMedis = RekamMedis::with('temuDokter.pet')->orderBy('created_at', 'desc')->get();
        $therapyCodes = TherapyActionCode::orderBy('kode')->get();
        
        return view('perawat.detail-rekam.create', compact('rekamMedis', 'therapyCodes'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $validated = $this->validateDetailRekam($request);

        $this->createDetailRekam($validated);

        return redirect()->route('perawat.detail-rekam.index')
            ->with('success', 'Detail rekam medis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $detailRekam = DetailRekamMedis::findOrFail($id);
        $rekamMedis = RekamMedis::with('temuDokter.pet')->orderBy('created_at', 'desc')->get();
        $therapyCodes = TherapyActionCode::orderBy('kode')->get();
        
        return view('perawat.detail-rekam.edit', compact('detailRekam', 'rekamMedis', 'therapyCodes'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $validated = $this->validateDetailRekam($request, $id);

        $detailRekam = DetailRekamMedis::findOrFail($id);
        $detailRekam->update($validated);

        return redirect()->route('perawat.detail-rekam.index')
            ->with('success', 'Detail rekam medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        $detailRekam = DetailRekamMedis::findOrFail($id);
        $detailRekam->delete();

        return redirect()->route('perawat.detail-rekam.index')
            ->with('success', 'Detail rekam medis berhasil dihapus.');
    }

    // Validation helper for Detail Rekam Medis
    protected function validateDetailRekam(Request $request, $id = null)
    {
        return $request->validate([
            'idrekam_medis' => 'required|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);
    }

    protected function createDetailRekam(array $data)
    {
        try {
            return DetailRekamMedis::create($data);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan detail rekam medis: ' . $e->getMessage());
        }
    }
}
