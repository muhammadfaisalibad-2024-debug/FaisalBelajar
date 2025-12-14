<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailRekamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        // Get dokter's idrole_user
        $roleUser = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            abort(403, 'Anda tidak terdaftar sebagai dokter aktif.');
        }

        $details = DB::table('detail_rekam_medis as drm')
            ->join('rekam_medis as rm', 'drm.idrekam_medis', '=', 'rm.idrekam_medis')
            ->join('kode_tindakan_terapi as ktt', 'drm.idkode_tindakan_terapi', '=', 'ktt.idkode_tindakan_terapi')
            ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->join('pet as p', 'td.idpet', '=', 'p.idpet')
            ->where('rm.dokter_pemeriksa', $roleUser->idrole_user)
            ->select(
                'drm.*',
                'ktt.kode',
                'ktt.deskripsi_tindakan_terapi',
                'p.nama as pet_name',
                'rm.created_at as tanggal_rekam'
            )
            ->orderBy('drm.iddetail_rekam_medis', 'desc')
            ->paginate(10);

        return view('dokter.detail-rekam.index', compact('details'));
    }

    public function create()
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        // Get dokter's idrole_user
        $roleUser = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            abort(403, 'Anda tidak terdaftar sebagai dokter aktif.');
        }

        // Get rekam medis milik dokter ini
        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
            ->select('r.idrekam_medis', 'r.created_at', 'p.nama as pet_name', 't.no_urut')
            ->orderBy('r.created_at', 'desc')
            ->get();

        $therapyCodes = DB::table('kode_tindakan_terapi')
            ->orderBy('kode')
            ->get();

        return view('dokter.detail-rekam.create', compact('rekamMedis', 'therapyCodes'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        $validated = $request->validate([
            'idrekam_medis' => 'required|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);

        // Get dokter's idrole_user
        $roleUser = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            return back()->with('error', 'Anda tidak terdaftar sebagai dokter aktif.');
        }

        // Verify rekam medis belongs to this dokter
        $rekamMedis = DB::table('rekam_medis')
            ->where('idrekam_medis', $validated['idrekam_medis'])
            ->where('dokter_pemeriksa', $roleUser->idrole_user)
            ->first();

        if (!$rekamMedis) {
            return back()->with('error', 'Anda tidak memiliki akses ke rekam medis ini.');
        }

        DB::table('detail_rekam_medis')->insert($validated);

        return redirect()->route('dokter.detail-rekam.index')
            ->with('success', 'Detail rekam medis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        // Get dokter's idrole_user
        $roleUser = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            abort(403, 'Anda tidak terdaftar sebagai dokter aktif.');
        }

        $detail = DB::table('detail_rekam_medis as drm')
            ->join('rekam_medis as rm', 'drm.idrekam_medis', '=', 'rm.idrekam_medis')
            ->where('drm.iddetail_rekam_medis', $id)
            ->where('rm.dokter_pemeriksa', $roleUser->idrole_user)
            ->select('drm.*')
            ->first();

        if (!$detail) {
            abort(404);
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
            ->select('r.idrekam_medis', 'r.created_at', 'p.nama as pet_name', 't.no_urut')
            ->orderBy('r.created_at', 'desc')
            ->get();

        $therapyCodes = DB::table('kode_tindakan_terapi')
            ->orderBy('kode')
            ->get();

        return view('dokter.detail-rekam.edit', compact('detail', 'rekamMedis', 'therapyCodes'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        $validated = $request->validate([
            'idrekam_medis' => 'required|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);

        // Get dokter's idrole_user
        $roleUser = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            return back()->with('error', 'Anda tidak terdaftar sebagai dokter aktif.');
        }

        // Verify access
        $detail = DB::table('detail_rekam_medis as drm')
            ->join('rekam_medis as rm', 'drm.idrekam_medis', '=', 'rm.idrekam_medis')
            ->where('drm.iddetail_rekam_medis', $id)
            ->where('rm.dokter_pemeriksa', $roleUser->idrole_user)
            ->first();

        if (!$detail) {
            abort(404);
        }

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $id)
            ->update($validated);

        return redirect()->route('dokter.detail-rekam.index')
            ->with('success', 'Detail rekam medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        // Get dokter's idrole_user
        $roleUser = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            return back()->with('error', 'Anda tidak terdaftar sebagai dokter aktif.');
        }

        // Verify access
        $detail = DB::table('detail_rekam_medis as drm')
            ->join('rekam_medis as rm', 'drm.idrekam_medis', '=', 'rm.idrekam_medis')
            ->where('drm.iddetail_rekam_medis', $id)
            ->where('rm.dokter_pemeriksa', $roleUser->idrole_user)
            ->first();

        if (!$detail) {
            abort(404);
        }

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $id)
            ->delete();

        return redirect()->route('dokter.detail-rekam.index')
            ->with('success', 'Detail rekam medis berhasil dihapus.');
    }
}
