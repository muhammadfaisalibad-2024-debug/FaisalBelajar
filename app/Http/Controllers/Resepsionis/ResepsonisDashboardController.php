<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ResepsonisDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $hasResepsonisRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 4)->exists();
        
        if (!$hasResepsonisRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Resepsionis.');
        }

        // Statistics
        $totalPemilik = DB::table('pemilik')->count();
        $totalPet = DB::table('pet')->count();
        $todayAppointments = DB::table('temu_dokter')
            ->whereDate('waktu_daftar', today())
            ->count();
        $pendingAppointments = DB::table('temu_dokter')
            ->where('status', 0)
            ->count();

        // Recent appointments
        $recentAppointments = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->join('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->join('user as d', 'ru.iduser', '=', 'd.iduser')
            ->select(
                't.*',
                'p.nama as pet_name',
                'u.nama as owner_name',
                'd.nama as dokter_name'
            )
            ->orderBy('t.waktu_daftar', 'desc')
            ->limit(5)
            ->get();

        // Recent owners
        $recentOwners = DB::table('pemilik as pm')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->select('pm.*', 'u.nama', 'u.email')
            ->orderBy('pm.idpemilik', 'desc')
            ->limit(5)
            ->get();

        return view('resepsionis.dashboard', compact(
            'totalPemilik',
            'totalPet',
            'todayAppointments',
            'pendingAppointments',
            'recentAppointments',
            'recentOwners'
        ));
    }
}
