<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UdhLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('masyarakat')->check() || Auth::guard('petugas')->check()) {
            if (Auth::guard('masyarakat')->check()) {
                return redirect()->route('masyarakat.dashboard');
            }
            if (Auth::guard('petugas')->check()) {
                return redirect('/petugas/dashboard');
            }
        }

        return $next($request);
    }
}
