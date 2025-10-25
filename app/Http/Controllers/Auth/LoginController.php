<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Login menggunakan nama (username) seperti sistem lama
        $credentials = [
            'nama' => $request->username,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role seperti sistem lama
            $user = Auth::user();
            $activeRole = $user->roles()->wherePivot('status', '1')->first();
            
            if ($activeRole) {
                switch ($activeRole->idrole) {
                    case 1: // Admin
                        return redirect('/dashboard');
                    case 4: // Resepsionis
                        return redirect('/dashboard');
                    case 3: // Perawat
                        return redirect('/dashboard');
                    case 9: // Dokter
                        return redirect('/dashboard');
                    case 11: // Pemilik
                        return redirect('/');
                    default:
                        Auth::logout();
                        return back()->withErrors(['username' => 'Role tidak dikenali.']);
                }
            }
            
            return redirect()->intended('/dashboard')
                ->with('success', 'Selamat datang, ' . Auth::user()->nama);
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Berhasil logout.');
    }
}
