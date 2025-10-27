<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
  
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        
        return view('auth.login');
    }

   
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

      
        $credentials = [
            'nama' => $request->username,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
        
            $user = Auth::user();
            $activeRole = $user->roles()->wherePivot('status', '1')->first();
            
            if ($activeRole) {
                switch ($activeRole->idrole) {
                    case 1: 
                        return redirect('/dashboard');
                    case 4: 
                        return redirect('/dashboard');
                    case 3: 
                        return redirect('/dashboard');
                    case 9: 
                        return redirect('/dashboard');
                    case 11: 
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

 
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Berhasil logout.');
    }
}
