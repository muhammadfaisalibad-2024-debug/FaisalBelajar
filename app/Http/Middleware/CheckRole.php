<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  Role ID to check (1=Admin, 2=Dokter, 3=Perawat, 4=Resepsionis)
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $hasRole = $user->roles()
            ->wherePivot('status', '1')
            ->where('role.idrole', $role)
            ->exists();

        if (!$hasRole) {
            abort(403, 'Unauthorized - Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
