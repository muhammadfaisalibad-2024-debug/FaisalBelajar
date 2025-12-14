<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = DB::table('dokter')
            ->join('user', 'dokter.iduser', '=', 'user.iduser')
            ->select('dokter.*', 'user.nama', 'user.email')
            ->orderBy('dokter.id_dokter', 'desc')
            ->paginate(10);

        return view('admin.dokter.index', compact('dokters'));
    }

    public function create()
    {
        return view('admin.dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateDokter($request);

        DB::beginTransaction();
        try {
            $userId = DB::table('user')->insertGetId([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            DB::table('role_user')->insert([
                'iduser' => $userId,
                'idrole' => 2,
                'status' => 1
            ]);

            DB::table('dokter')->insert([
                'alamat' => $validated['alamat'],
                'no_hp' => $validated['no_hp'],
                'bidang_dokter' => $validated['bidang_dokter'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'iduser' => $userId
            ]);

            DB::commit();
            return redirect()->route('admin.dokter.index')
                ->with('success', 'Data dokter berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal menambahkan dokter: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $dokter = DB::table('dokter')
            ->join('user', 'dokter.iduser', '=', 'user.iduser')
            ->where('dokter.id_dokter', $id)
            ->select('dokter.*', 'user.nama', 'user.email')
            ->first();

        if (!$dokter) abort(404);
        return view('admin.dokter.edit', compact('dokter'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateDokter($request, $id);
        $dokter = DB::table('dokter')->where('id_dokter', $id)->first();
        
        if (!$dokter) abort(404);

        DB::beginTransaction();
        try {
            $userData = [
                'nama' => $validated['nama'],
                'email' => $validated['email'],
            ];
            
            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            DB::table('user')
                ->where('iduser', $dokter->iduser)
                ->update($userData);

            DB::table('dokter')
                ->where('id_dokter', $id)
                ->update([
                    'alamat' => $validated['alamat'],
                    'no_hp' => $validated['no_hp'],
                    'bidang_dokter' => $validated['bidang_dokter'],
                    'jenis_kelamin' => $validated['jenis_kelamin']
                ]);

            DB::commit();
            return redirect()->route('admin.dokter.index')
                ->with('success', 'Data dokter berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal mengupdate dokter: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $dokter = DB::table('dokter')->where('id_dokter', $id)->first();
            if (!$dokter) abort(404);

            DB::table('dokter')->where('id_dokter', $id)->delete();
            DB::table('role_user')->where('iduser', $dokter->iduser)->delete();
            DB::table('user')->where('iduser', $dokter->iduser)->delete();

            DB::commit();
            return redirect()->route('admin.dokter.index')
                ->with('success', 'Data dokter berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus dokter: ' . $e->getMessage());
        }
    }

    protected function validateDokter(Request $request, $id = null)
    {
        $dokter = $id ? DB::table('dokter')->where('id_dokter', $id)->first() : null;
        $userId = $dokter ? $dokter->iduser : null;

        $rules = [
            'nama' => 'required|string|max:500',
            'email' => 'required|email|unique:user,email' . ($userId ? ",$userId,iduser" : ''),
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'bidang_dokter' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
        ];

        if (!$id) {
            $rules['password'] = 'required|string|min:6';
        } else {
            $rules['password'] = 'nullable|string|min:6';
        }

        return $request->validate($rules);
    }
}
