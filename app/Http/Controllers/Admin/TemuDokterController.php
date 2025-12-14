<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TemuDokterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $temuDokter = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as owner_user', 'pm.iduser', '=', 'owner_user.iduser')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->select(
                't.idreservasi_dokter',
                't.waktu_daftar',
                't.no_urut',
                't.status',
                'p.nama as pet_name',
                'owner_user.nama as owner_name',
                DB::raw("COALESCE(u.nama, '-') as dokter_name")
            )
            ->orderBy('t.waktu_daftar', 'desc')
            ->paginate(10);

        return view('admin.temu-dokter.index', compact('temuDokter'));
    }

    public function create()
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $pets = DB::table('pet as p')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->select('p.idpet', 'p.nama as pet_name', 'pm.nama as owner_name')
            ->orderBy('pm.nama')
            ->get();

        $dokters = DB::table('role_user as ru')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->where('ru.idrole', 2)
            ->where('ru.status', 1)
            ->select('ru.idrole_user', 'u.nama')
            ->orderBy('u.nama')
            ->get();

        return view('admin.temu-dokter.create', compact('pets', 'dokters'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $validated = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'status' => 'required|in:1,2,3',
        ]);

        DB::table('temu_dokter')->insert([
            'idpet' => $validated['idpet'],
            'idrole_user' => $validated['idrole_user'],
            'status' => $validated['status'],
            'waktu_daftar' => now()->format('Y-m-d H:i:s'),
            'no_urut' => DB::table('temu_dokter')->whereDate('waktu_daftar', today())->count() + 1,
        ]);

        return redirect()->route('admin.temu-dokter.index')
            ->with('success', 'Temu dokter berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $temuDokter = DB::table('temu_dokter')
            ->where('idreservasi_dokter', $id)
            ->select('idreservasi_dokter', 'no_urut', 'waktu_daftar', 'status', 'idpet', 'idrole_user')
            ->first();

        if (!$temuDokter) {
            abort(404);
        }

        $pets = DB::table('pet as p')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as owner_user', 'pm.iduser', '=', 'owner_user.iduser')
            ->select('p.idpet', 'p.nama as pet_name', 'owner_user.nama as owner_name')
            ->orderBy('owner_user.nama')
            ->get();

        $dokters = DB::table('role_user as ru')
            ->join('user as u', 'ru.iduser', '=', 'u.iduser')
            ->where('ru.idrole', 2)
            ->where('ru.status', 1)
            ->select('ru.idrole_user', 'u.nama')
            ->orderBy('u.nama')
            ->get();

        return view('admin.temu-dokter.edit', compact('temuDokter', 'pets', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $validated = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'status' => 'required|in:1,2,3',
        ]);

        DB::table('temu_dokter')
            ->where('idreservasi_dokter', $id)
            ->update($validated);

        return redirect()->route('admin.temu-dokter.index')
            ->with('success', 'Temu dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        DB::table('temu_dokter')
            ->where('idreservasi_dokter', $id)
            ->delete();

        return redirect()->route('admin.temu-dokter.index')
            ->with('success', 'Temu dokter berhasil dihapus.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $temuDokter = DB::table('temu_dokter as t')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as owner_user', 'pm.iduser', '=', 'owner_user.iduser')
            ->leftJoin('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->leftJoin('user as u', 'ru.iduser', '=', 'u.iduser')
            ->where('t.idreservasi_dokter', $id)
            ->select(
                't.idreservasi_dokter',
                't.waktu_daftar',
                't.no_urut',
                't.status',
                'p.nama as pet_name',
                'owner_user.nama as owner_name',
                'pm.no_wa as owner_phone',
                DB::raw("COALESCE(u.nama, '-') as dokter_name")
            )
            ->first();

        if (!$temuDokter) {
            abort(404);
        }

        return view('admin.temu-dokter.show', compact('temuDokter'));
    }
}
