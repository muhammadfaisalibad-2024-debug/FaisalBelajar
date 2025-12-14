<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Owner;
use App\Models\AnimalType;
use App\Models\AnimalBreed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    
    public function index()
    {
        $pets = Pet::with(['owner', 'animalBreed.animalType'])
            ->orderBy('idpet', 'desc')
            ->paginate(10);
        return view('admin.pet.index', compact('pets'));
    }

    
    public function create()
    {
        $owners = Owner::with('user')->get();
        $animalTypes = AnimalType::orderBy('nama_jenis_hewan')->get();
        return view('admin.pet.create', compact('owners', 'animalTypes'));
    }

   
    public function store(Request $request)
    {
        $validated = $this->validatePet($request);

        $this->createPet($validated);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data hewan berhasil ditambahkan.');
    }

    
    public function edit($id)
    {
        // Query Builder: ambil data pet by ID
        $pet = DB::table('pet')->where('idpet', $id)->first();
        
        if (!$pet) {
            abort(404);
        }

        $owners = Owner::with('user')->get();
        $animalTypes = AnimalType::orderBy('nama_jenis_hewan')->get();
        
        // Ambil idjenis_hewan dari ras_hewan dulu
        $rasHewan = DB::table('ras_hewan')->where('idras_hewan', $pet->idras_hewan)->first();
        $animalBreeds = AnimalBreed::where('idjenis_hewan', $rasHewan->idjenis_hewan ?? null)
            ->orderBy('nama_ras')
            ->get();
        
        return view('admin.pet.edit', compact('pet', 'owners', 'animalTypes', 'animalBreeds'));
    }

    
    public function update(Request $request, $id)
    {
        $validated = $this->validatePet($request, $id);

        // Query Builder: update
        DB::table('pet')
            ->where('idpet', $id)
            ->update($validated);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data hewan berhasil diperbarui.');
    }

    
    public function destroy($id)
    {
        // Query Builder: delete
        DB::table('pet')->where('idpet', $id)->delete();

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data hewan berhasil dihapus.');
    }

    
    public function getBreedsByType($animalTypeId)
    {
        $breeds = AnimalBreed::where('idjenis_hewan', $animalTypeId)
            ->orderBy('nama_ras')
            ->get();
        
        return response()->json($breeds);
    }

    // Validation helper for Pet
    protected function validatePet(Request $request, $id = null)
    {
        return $request->validate([
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'nullable|date',
            'warna_tanda' => 'nullable|string|max:45',
        ]);
    }

    // Create helper for Pet using Query Builder
    protected function createPet(array $data)
    {
        try {
            // Query Builder: insert
            return DB::table('pet')->insertGetId($data);
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data hewan: ' . $e->getMessage());
        }
    }
}


