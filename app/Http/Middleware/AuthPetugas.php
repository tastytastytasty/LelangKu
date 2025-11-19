<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthPetugas
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('petugas')->check()) {
            return redirect('/petugas/login');
        }

        return $next($request);
    }
}
