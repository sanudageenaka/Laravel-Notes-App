<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
            if ($role === 'admin' && $request->path() === 'dashboard') {
                return redirect('/admin/dashboard');
            } elseif ($role === 'user' && $request->path() === 'dashboard') {
                return redirect('/user/dashboard');
            }
        }
        return $next($request);
    }
}
