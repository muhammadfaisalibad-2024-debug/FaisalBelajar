<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerawatDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        // Get perawat profile
        $perawat = DB::table('perawat')->where('iduser', $user->iduser)->first();

        // Statistics
        $totalPasien = DB::table('pet')->count();
        $totalRekamMedis = DB::table('rekam_medis')->count();
        $recentRekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->select('r.*', 'p.nama as pet_name', 'u.nama as owner_name', 't.no_urut')
            ->orderBy('r.created_at', 'desc')
            ->limit(5)
            ->get();

        return view('perawat.dashboard', compact('perawat', 'totalPasien', 'totalRekamMedis', 'recentRekamMedis'));
    }

    // View data pasien
    public function pasien()
    {
        $user = Auth::user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
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

        return view('perawat.pasien.index', compact('pets'));
    }

    // View profil perawat
    public function profil()
    {
        $user = Auth::user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403);
        }

        $perawat = DB::table('perawat')
            ->join('user', 'perawat.iduser', '=', 'user.iduser')
            ->where('perawat.iduser', $user->iduser)
            ->select('perawat.*', 'user.nama', 'user.email')
            ->first();

        if (!$perawat) {
            abort(404, 'Profil perawat tidak ditemukan');
        }

        return view('perawat.profil', compact('perawat'));
    }
}
