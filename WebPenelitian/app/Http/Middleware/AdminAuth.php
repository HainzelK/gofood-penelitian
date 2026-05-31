<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika di dalam session tidak ada tanda 'admin_logged_in', tendang ke login
        if (!$request->session()->has('admin_logged_in')) {
            return redirect()->route('admin.login.form')->with('error', 'Silakan login terlebih dahulu.');
        }
    
        return $next($request);
    }
}
