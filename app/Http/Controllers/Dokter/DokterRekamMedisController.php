<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class DokterRekamMedisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Dokter.');
        }

        $rekamMedis = RekamMedis::with(['dokter', 'temuDokter.pet.owner'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('dokter.rekam-medis.index', compact('rekamMedis'));
    }

    public function show($id)
    {
        $user = auth()->user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 2)->exists();
        
        if (!$hasDokterRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Dokter.');
        }

        $rekamMedis = RekamMedis::with(['dokter', 'temuDokter.pet.owner', 'details.kodeTindakan'])
            ->findOrFail($id);
        return view('dokter.rekam-medis.show', compact('rekamMedis'));
    }
}
