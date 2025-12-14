<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemilikDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // Get pemilik profile
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('pemilik.iduser', $user->iduser)
            ->select('pemilik.*', 'user.nama', 'user.email')
            ->first();

        if (!$pemilik) {
            return redirect()->route('home')->with('error', 'Profil pemilik tidak ditemukan.');
        }

        // Statistics
        $totalPets = DB::table('pet')
            ->where('idpemilik', $pemilik->idpemilik)
            ->count();

        $upcomingAppointments = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->whereDate('t.waktu_daftar', '>=', today())
            ->count();

        $totalRekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->count();

        // Recent appointments
        $recentAppointments = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->select(
                't.idreservasi_dokter',
                't.waktu_daftar',
                't.no_urut',
                't.status',
                'p.nama as pet_name',
                DB::raw("COALESCE(u.nama, '-') as dokter_name")
            )
            ->orderBy('t.waktu_daftar', 'desc')
            ->limit(5)
            ->get();

        // My pets
        $myPets = DB::table('pet as p')
            ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->leftJoin('jenis_hewan as j', 'r.idjenis_hewan', '=', 'j.idjenis_hewan')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->select('p.*', 'r.nama_ras', 'j.nama_jenis_hewan')
            ->get();

        return view('pemilik.dashboard', compact(
            'pemilik',
            'totalPets',
            'upcomingAppointments',
            'totalRekamMedis',
            'recentAppointments',
            'myPets'
        ));
    }

    // View jadwal temu dokter
    public function jadwal()
    {
        $user = Auth::user();
        $pemilik = DB::table('pemilik')->where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            abort(404);
        }

        $appointments = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->leftJoin('rekam_medis as r', 't.idreservasi_dokter', '=', 'r.idreservasi_dokter')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->select(
                't.idreservasi_dokter',
                't.waktu_daftar',
                't.no_urut',
                't.status',
                'p.nama as pet_name',
                DB::raw("COALESCE(u.nama, '-') as dokter_name"),
                DB::raw("COALESCE(r.anamnesa, '-') as keluhan")
            )
            ->orderBy('t.waktu_daftar', 'desc')
            ->paginate(10);

        return view('pemilik.jadwal', compact('appointments'));
    }

    // View rekam medis
    public function rekamMedis()
    {
        $user = Auth::user();
        $pemilik = DB::table('pemilik')->where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            abort(404);
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 'r.dokter_pemeriksa', '=', 'ru.idrole_user')
            ->leftJoin('user as d', 'ru.iduser', '=', 'd.iduser')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->select(
                'r.*',
                'p.nama as pet_name',
                DB::raw("COALESCE(d.nama, '-') as dokter_name"),
                't.waktu_daftar'
            )
            ->orderBy('r.created_at', 'desc')
            ->paginate(10);

        return view('pemilik.rekam-medis', compact('rekamMedis'));
    }

    public function showRekamMedis($id)
    {
        $user = Auth::user();
        $pemilik = DB::table('pemilik')->where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            abort(404);
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->leftJoin('role_user as ru', 'r.dokter_pemeriksa', '=', 'ru.idrole_user')
            ->leftJoin('user as d', 'ru.iduser', '=', 'd.iduser')
            ->where('r.idrekam_medis', $id)
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->select(
                'r.*',
                'p.nama as pet_name',
                'p.jenis_kelamin',
                DB::raw("COALESCE(d.nama, '-') as dokter_name"),
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

        return view('pemilik.rekam-medis-detail', compact('rekamMedis', 'details'));
    }

    // View profil dan pet yang dimiliki
    public function profil()
    {
        $user = Auth::user();
        $pemilik = DB::table('pemilik')
            ->join('user', 'pemilik.iduser', '=', 'user.iduser')
            ->where('pemilik.iduser', $user->iduser)
            ->select('pemilik.*', 'user.nama as nama', 'user.email as email')
            ->first();

        if (!$pemilik) {
            abort(404);
        }

        $pets = DB::table('pet as p')
            ->leftJoin('ras_hewan as r', 'p.idras_hewan', '=', 'r.idras_hewan')
            ->leftJoin('jenis_hewan as j', 'r.idjenis_hewan', '=', 'j.idjenis_hewan')
            ->where('p.idpemilik', $pemilik->idpemilik)
            ->select('p.*', 'r.nama_ras', 'j.nama_jenis_hewan')
            ->orderBy('p.idpet', 'desc')
            ->get();

        return view('pemilik.profil', compact('pemilik', 'pets'));
    }
}
