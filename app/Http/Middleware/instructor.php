<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class instructor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $role = Auth::user()->role;

        if ($role == 'instructor') {
            return $next($request);
        }

        if ($role == 'admin') {
            return redirect()->route('admin');
        }


        if ($role == 'user') {
            return redirect()->route('dashboard');
        }
        return $next($request);
    }
}
