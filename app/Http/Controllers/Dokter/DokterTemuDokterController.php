<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use Illuminate\Http\Request;

class DokterTemuDokterController extends Controller
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

       
        $roleUser = \App\Models\RoleUser::where('iduser', $user->iduser)
            ->where('role.idrole', 2)
            ->where('status', 1)
            ->first();
            
        $temuDokter = TemuDokter::with(['pet.owner', 'roleUser.user'])
            ->where('idrole_user', $roleUser->idrole_user ?? 0)
            ->orderBy('waktu_daftar', 'desc')
            ->paginate(10);
            
        return view('dokter.temu-dokter.index', compact('temuDokter'));
    }

    public function show($id)
    {
        $user = auth()->user();
        $hasDokterRole = $user->roles()->wherePivot('status', '1')->where('role.idrole', 9)->exists();
        
        if (!$hasDokterRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses sebagai Dokter.');
        }

        $temuDokter = TemuDokter::with(['pet.owner', 'roleUser.user'])->findOrFail($id);
        return view('dokter.temu-dokter.show', compact('temuDokter'));
    }
}
