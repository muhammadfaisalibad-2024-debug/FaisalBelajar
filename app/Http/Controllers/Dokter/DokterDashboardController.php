<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DokterDashboardController extends Controller
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
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Dokter.');
        }

        // Get dokter profile
        $dokter = DB::table('dokter')->where('iduser', $user->iduser)->first();

        if (!$dokter) {
            return redirect()->route('home')->with('error', 'Profil dokter tidak ditemukan.');
        }

        // Get dokter's idrole_user
        $roleUser = \App\Models\RoleUser::where('iduser', $user->iduser)
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            return redirect()->route('home')->with('error', 'Profil dokter tidak ditemukan.');
        }

        // Statistics
        $totalPasien = DB::table('pet')->count();
        $totalRekamMedis = DB::table('rekam_medis')
            ->where('dokter_pemeriksa', $roleUser->idrole_user)
            ->count();
        $totalTemuDokter = DB::table('temu_dokter')
            ->where('idrole_user', $roleUser->idrole_user)
            ->count();
        
        // Recent rekam medis by this dokter
        $recentRekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
            ->select('r.*', 'p.nama as pet_name', 'u.nama as owner_name', 't.no_urut')
            ->orderBy('r.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dokter.dashboard', compact('dokter', 'totalPasien', 'totalRekamMedis', 'totalTemuDokter', 'recentRekamMedis'));
    }

    // View all pasien
    public function pasien()
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        $pets = DB::table('pet as p')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
            ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->leftJoin('jenis_hewan as j', 'r.idjenis_hewan', '=', 'j.idjenis_hewan')
            ->select(
                'p.*',
                'u.nama as pemilik_nama',
                'r.nama_ras',
                'j.nama_jenis_hewan'
            )
            ->orderBy('p.idpet', 'desc')
            ->paginate(10);

        return view('dokter.pasien.index', compact('pets'));
    }

    // View rekam medis (dokter can only view)
    public function rekamMedis()
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        // Get dokter's idrole_user
        $roleUser = \App\Models\RoleUser::where('iduser', $user->iduser)
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            abort(403, 'Profil dokter tidak ditemukan');
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as owner', 'pm.iduser', '=', 'owner.iduser')
            ->join('role_user as ru', 'r.dokter_pemeriksa', '=', 'ru.idrole_user')
            ->join('user as dokter', 'ru.iduser', '=', 'dokter.iduser')
            ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
            ->select(
                'r.*',
                'p.nama as pet_name',
                'owner.nama as owner_name',
                'dokter.nama as dokter_name',
                't.no_urut'
            )
            ->orderBy('r.created_at', 'desc')
            ->paginate(10);

        return view('dokter.rekam-medis.index', compact('rekamMedis'));
    }

    // Show single rekam medis with details
    public function showRekamMedis($id)
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        // Get dokter's idrole_user
        $roleUser = \App\Models\RoleUser::where('iduser', $user->iduser)
            ->where('idrole', 2)
            ->where('status', 1)
            ->first();

        if (!$roleUser) {
            abort(403, 'Profil dokter tidak ditemukan');
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as owner', 'pm.iduser', '=', 'owner.iduser')
            ->join('role_user as ru', 'r.dokter_pemeriksa', '=', 'ru.idrole_user')
            ->join('user as dokter', 'ru.iduser', '=', 'dokter.iduser')
            ->where('r.idrekam_medis', $id)
            ->where('r.dokter_pemeriksa', $roleUser->idrole_user)
            ->select(
                'r.*',
                'p.nama as pet_name',
                'p.jenis_kelamin as pet_gender',
                'owner.nama as owner_name',
                'dokter.nama as dokter_name',
                't.no_urut',
                't.waktu_daftar'
            )
            ->first();

        if (!$rekamMedis) {
            abort(404, 'Rekam medis tidak ditemukan');
        }

        // Get detail rekam medis
        $details = DB::table('detail_rekam_medis as d')
            ->join('kode_tindakan_terapi as k', 'd.idkode_tindakan_terapi', '=', 'k.idkode_tindakan_terapi')
            ->where('d.idrekam_medis', $id)
            ->select('d.*', 'k.kode', 'k.deskripsi_tindakan_terapi')
            ->get();

        return view('dokter.rekam-medis.show', compact('rekamMedis', 'details'));
    }

    // View profil dokter
    public function profil()
    {
        $user = Auth::user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403);
        }

        $dokter = DB::table('dokter')
            ->join('user', 'dokter.iduser', '=', 'user.iduser')
            ->where('dokter.iduser', $user->iduser)
            ->select('dokter.*', 'user.nama', 'user.email')
            ->first();

        if (!$dokter) {
            abort(404, 'Profil dokter tidak ditemukan');
        }

        return view('dokter.profil', compact('dokter'));
    }
}
