<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PerawatController extends Controller
{
    public function index()
    {
        $perawats = DB::table('perawat')
            ->join('user', 'perawat.iduser', '=', 'user.iduser')
            ->select('perawat.*', 'user.nama', 'user.email')
            ->orderBy('perawat.id_perawat', 'desc')
            ->paginate(10);

        return view('admin.perawat.index', compact('perawats'));
    }

    public function create()
    {
        return view('admin.perawat.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatePerawat($request);

        DB::beginTransaction();
        try {
            $userId = DB::table('user')->insertGetId([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            DB::table('role_user')->insert([
                'iduser' => $userId,
                'idrole' => 3,
                'status' => 1
            ]);

            DB::table('perawat')->insert([
                'alamat' => $validated['alamat'],
                'no_hp' => $validated['no_hp'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'pendidikan' => $validated['pendidikan'],
                'iduser' => $userId
            ]);

            DB::commit();
            return redirect()->route('admin.perawat.index')
                ->with('success', 'Data perawat berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal menambahkan perawat: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $perawat = DB::table('perawat')
            ->join('user', 'perawat.iduser', '=', 'user.iduser')
            ->where('perawat.id_perawat', $id)
            ->select('perawat.*', 'user.nama', 'user.email')
            ->first();

        if (!$perawat) abort(404);
        return view('admin.perawat.edit', compact('perawat'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validatePerawat($request, $id);
        $perawat = DB::table('perawat')->where('id_perawat', $id)->first();
        
        if (!$perawat) abort(404);

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
                ->where('iduser', $perawat->iduser)
                ->update($userData);

            DB::table('perawat')
                ->where('id_perawat', $id)
                ->update([
                    'alamat' => $validated['alamat'],
                    'no_hp' => $validated['no_hp'],
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                    'pendidikan' => $validated['pendidikan']
                ]);

            DB::commit();
            return redirect()->route('admin.perawat.index')
                ->with('success', 'Data perawat berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal mengupdate perawat: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $perawat = DB::table('perawat')->where('id_perawat', $id)->first();
            if (!$perawat) abort(404);

            DB::table('perawat')->where('id_perawat', $id)->delete();
            DB::table('role_user')->where('iduser', $perawat->iduser)->delete();
            DB::table('user')->where('iduser', $perawat->iduser)->delete();

            DB::commit();
            return redirect()->route('admin.perawat.index')
                ->with('success', 'Data perawat berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus perawat: ' . $e->getMessage());
        }
    }

    protected function validatePerawat(Request $request, $id = null)
    {
        $perawat = $id ? DB::table('perawat')->where('id_perawat', $id)->first() : null;
        $userId = $perawat ? $perawat->iduser : null;

        $rules = [
            'nama' => 'required|string|max:500',
            'email' => 'required|email|unique:user,email' . ($userId ? ",$userId,iduser" : ''),
            'alamat' => 'required|string|max:100',
            'no_hp' => 'required|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'pendidikan' => 'required|string|max:100',
        ];

        if (!$id) {
            $rules['password'] = 'required|string|min:6';
        } else {
            $rules['password'] = 'nullable|string|min:6';
        }

        return $request->validate($rules);
    }
}
