<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class DokterPetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 9)->exists();
        
        if (!$hasDokterRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Dokter.');
        }

        $pets = Pet::with(['owner', 'animalType', 'animalBreed'])->paginate(10);
        return view('dokter.pet.index', compact('pets'));
    }

    public function show($id)
    {
        $user = auth()->user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 9)->exists();
        
        if (!$hasDokterRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Dokter.');
        }

        $pet = Pet::with(['owner', 'animalType', 'animalBreed'])->findOrFail($id);
        return view('dokter.pet.show', compact('pet'));
    }
}
