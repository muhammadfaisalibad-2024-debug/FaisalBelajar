<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerawatDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Cek apakah user memiliki role Perawat (ID: 3)
        $user = auth()->user();
        $hasPerawatRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 3)->exists();
        
        if (!$hasPerawatRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Perawat.');
        }

        return view('perawat.dashboard');
    }
}
