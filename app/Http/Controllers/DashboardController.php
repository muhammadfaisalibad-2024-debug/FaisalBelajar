<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\AnimalType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Redirect based on role
        $roles = $user->roles()->wherePivot('status', '1')->get();
        
        foreach ($roles as $role) {
            switch ($role->idrole) {
                case 1: // Admin
                    return $this->adminDashboard();
                case 2: // Dokter
                    return redirect()->route('dokter.dashboard');
                case 3: // Perawat
                    return redirect()->route('perawat.dashboard');
                case 4: // Resepsionis
                    return redirect()->route('resepsionis.dashboard');
                default:
                    // Check if user is pemilik
                    $pemilik = \App\Models\Owner::where('iduser', $user->iduser)->first();
                    if ($pemilik) {
                        return redirect()->route('pemilik.dashboard');
                    }
            }
        }
        
        // Default fallback
        return $this->adminDashboard();
    }

    private function adminDashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_owners' => Owner::count(),
            'total_pets' => Pet::count(),
            'total_animal_types' => AnimalType::count(),
        ];

        $recentPets = Pet::with(['owner', 'animalBreed'])
            ->orderBy('idpet', 'desc')
            ->take(5)
            ->get();

        $recentOwners = Owner::with('user')
            ->orderBy('idpemilik', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPets', 'recentOwners'));
    }
}
