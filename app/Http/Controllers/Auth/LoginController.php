<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  
    

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        // Support login dengan email atau nama (username)
        $loginField = request()->input('email');
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'nama';
        request()->merge([$fieldType => $loginField]);
        return $fieldType;
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

      
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Get active role dari user
        $activeRole = $user->roles()->wherePivot('status', '1')->first();
        
        if ($activeRole) {
            switch ($activeRole->idrole) {
                case 1: // Admin
                    return redirect('/dashboard')->with('success', 'Selamat datang, ' . $user->nama);
                case 3: // Perawat
                    return redirect('/perawat/dashboard')->with('success', 'Selamat datang, ' . $user->nama);
                case 4: // Resepsionis
                    return redirect('/resepsionis/dashboard')->with('success', 'Selamat datang, ' . $user->nama);
                case 9: // Dokter
                    return redirect('/dokter/dashboard')->with('success', 'Selamat datang, ' . $user->nama);
                case 11: // Pemilik
                    return redirect('/')->with('success', 'Selamat datang, ' . $user->nama);
                default:
                    return redirect('/dashboard')->with('success', 'Selamat datang, ' . $user->nama);
            }
        }
        
        // Fallback jika tidak ada role aktif
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email atau Username harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);
    }
}
