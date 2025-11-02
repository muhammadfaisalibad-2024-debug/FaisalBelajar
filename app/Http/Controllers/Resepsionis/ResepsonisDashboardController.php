<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResepsonisDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Cek apakah user memiliki role Resepsionis (ID: 4)
        $user = auth()->user();
        $hasResepsonisRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 4)->exists();
        
        if (!$hasResepsonisRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Resepsionis.');
        }

        return view('resepsionis.dashboard');
    }
}
