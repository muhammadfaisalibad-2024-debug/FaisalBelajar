<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as owner_user', 'pm.iduser', '=', 'owner_user.iduser')
            ->leftJoin('role_user as ru', 'r.dokter_pemeriksa', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                'r.*',
                'p.nama as pet_name',
                'owner_user.nama as owner_name',
                DB::raw("COALESCE(u.nama, '-') as dokter_name"),
                't.no_urut'
            )
            ->orderBy('r.created_at', 'desc')
            ->paginate(10);

        return view('admin.rekam-medis.index', compact('rekamMedis'));
    }

    public function create()
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $temuDokter = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                't.idreservasi_dokter',
                't.no_urut',
                't.waktu_daftar',
                'p.nama as pet_name',
                'u.nama as dokter_name'
            )
            ->orderBy('t.waktu_daftar', 'desc')
            ->get();

        return view('admin.rekam-medis.create', compact('temuDokter'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $validated = $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'required|string',
        ]);

        // Get dokter from temu_dokter
        $temuDokter = DB::table('temu_dokter')
            ->where('idreservasi_dokter', $validated['idreservasi_dokter'])
            ->first();

        if (!$temuDokter) {
            return back()->with('error', 'Temu dokter tidak ditemukan.');
        }

        DB::table('rekam_medis')->insert([
            'idreservasi_dokter' => $validated['idreservasi_dokter'],
            'dokter_pemeriksa' => $temuDokter->idrole_user,
            'anamnesa' => $validated['anamnesa'],
            'temuan_klinis' => $validated['temuan_klinis'],
            'diagnosa' => $validated['diagnosa'],
        ]);

        return redirect()->route('admin.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $rekamMedis = DB::table('rekam_medis')->where('idrekam_medis', $id)->first();

        if (!$rekamMedis) {
            abort(404);
        }

        $temuDokter = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                't.idreservasi_dokter',
                't.no_urut',
                't.waktu_daftar',
                'p.nama as pet_name',
                'u.nama as dokter_name'
            )
            ->orderBy('t.waktu_daftar', 'desc')
            ->get();

        return view('admin.rekam-medis.edit', compact('rekamMedis', 'temuDokter'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $validated = $request->validate([
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'required|string',
        ]);

        DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->update([
                'anamnesa' => $validated['anamnesa'],
                'temuan_klinis' => $validated['temuan_klinis'],
                'diagnosa' => $validated['diagnosa'],
            ]);

        return redirect()->route('admin.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->delete();

        return redirect()->route('admin.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil dihapus.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 'r.dokter_pemeriksa', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->where('r.idrekam_medis', $id)
            ->select(
                'r.*',
                'p.nama as pet_name',
                'p.jenis_kelamin',
                DB::raw("COALESCE(u.nama, '-') as dokter_name"),
                't.no_urut',
                't.waktu_daftar'
            )
            ->first();

        if (!$rekamMedis) {
            abort(404);
        }

        // Get details
        $details = DB::table('detail_rekam_medis as drm')
            ->join('kode_tindakan_terapi as ktt', 'drm.idkode_tindakan_terapi', '=', 'ktt.idkode_tindakan_terapi')
            ->where('drm.idrekam_medis', $id)
            ->select('drm.*', 'ktt.kode', 'ktt.deskripsi_tindakan_terapi')
            ->get();

        return view('admin.rekam-medis.show', compact('rekamMedis', 'details'));
    }
}
