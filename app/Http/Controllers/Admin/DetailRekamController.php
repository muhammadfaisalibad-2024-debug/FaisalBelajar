<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailRekamController extends Controller
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

        $detailRekam = DB::table('detail_rekam_medis as drm')
            ->join('rekam_medis as rm', 'drm.idrekam_medis', '=', 'rm.idrekam_medis')
            ->join('kode_tindakan_terapi as ktt', 'drm.idkode_tindakan_terapi', '=', 'ktt.idkode_tindakan_terapi')
            ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->join('pet as p', 'td.idpet', '=', 'p.idpet')
            ->select(
                'drm.*',
                'ktt.kode',
                'ktt.deskripsi_tindakan_terapi',
                'p.nama as pet_name',
                'rm.created_at as tanggal_rekam'
            )
            ->orderBy('drm.iddetail_rekam_medis', 'desc')
            ->paginate(10);

        return view('admin.detail-rekam.index', compact('detailRekam'));
    }

    public function create()
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->select('r.idrekam_medis', 'r.created_at', 'p.nama as pet_name', 't.no_urut')
            ->orderBy('r.created_at', 'desc')
            ->get();

        $therapyCodes = DB::table('kode_tindakan_terapi')
            ->orderBy('kode')
            ->get();

        return view('admin.detail-rekam.create', compact('rekamMedis', 'therapyCodes'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $validated = $request->validate([
            'idrekam_medis' => 'required|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);

        DB::table('detail_rekam_medis')->insert($validated);

        return redirect()->route('admin.detail-rekam.index')
            ->with('success', 'Detail rekam medis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $detail = DB::table('detail_rekam_medis')->where('iddetail_rekam_medis', $id)->first();

        if (!$detail) {
            abort(404);
        }

        $rekamMedis = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->select('r.idrekam_medis', 'r.created_at', 'p.nama as pet_name', 't.no_urut')
            ->orderBy('r.created_at', 'desc')
            ->get();

        $therapyCodes = DB::table('kode_tindakan_terapi')
            ->orderBy('kode')
            ->get();

        return view('admin.detail-rekam.edit', compact('detail', 'rekamMedis', 'therapyCodes'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $validated = $request->validate([
            'idrekam_medis' => 'required|exists:rekam_medis,idrekam_medis',
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string',
        ]);

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $id)
            ->update($validated);

        return redirect()->route('admin.detail-rekam.index')
            ->with('success', 'Detail rekam medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        DB::table('detail_rekam_medis')
            ->where('iddetail_rekam_medis', $id)
            ->delete();

        return redirect()->route('admin.detail-rekam.index')
            ->with('success', 'Detail rekam medis berhasil dihapus.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $isAdmin = $user->roles()->wherePivot('status', '1')->where('role.idrole', 1)->exists();
        
        if (!$isAdmin) {
            abort(403, 'Unauthorized - Admin only.');
        }

        $detail = DB::table('detail_rekam_medis as drm')
            ->join('rekam_medis as rm', 'drm.idrekam_medis', '=', 'rm.idrekam_medis')
            ->join('kode_tindakan_terapi as ktt', 'drm.idkode_tindakan_terapi', '=', 'ktt.idkode_tindakan_terapi')
            ->join('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->join('pet as p', 'td.idpet', '=', 'p.idpet')
            ->where('drm.iddetail_rekam_medis', $id)
            ->select(
                'drm.*',
                'ktt.kode',
                'ktt.deskripsi_tindakan_terapi',
                'p.nama as pet_name',
                'rm.created_at as tanggal_rekam'
            )
            ->first();

        if (!$detail) {
            abort(404);
        }

        return view('admin.detail-rekam.show', compact('detail'));
    }
}
