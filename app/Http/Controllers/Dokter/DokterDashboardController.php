<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokterDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Cek apakah user memiliki role Dokter (ID: 9)
        $user = auth()->user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 9)->exists();
        
        if (!$hasDokterRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Dokter.');
        }

        return view('dokter.dashboard');
    }
}
