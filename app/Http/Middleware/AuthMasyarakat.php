<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthMasyarakat
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('masyarakat')->check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}
