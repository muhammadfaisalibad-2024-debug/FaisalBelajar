<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\AnimalType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
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
