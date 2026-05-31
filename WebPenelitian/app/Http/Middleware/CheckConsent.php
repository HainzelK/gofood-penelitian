<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckConsent
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika user belum punya session 'consent_accepted' dan tidak sedang di halaman consent
        if (!$request->session()->has('consent_accepted') && !$request->is('consent*')) {
            return redirect('/consent');
        }
    
        return $next($request);
    }
}
