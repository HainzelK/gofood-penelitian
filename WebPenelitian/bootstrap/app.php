<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // DAFTARKAN ALIAS DI SINI:
        $middleware->alias([
            // Jika pakai cara ini tetap error, berarti file AdminAuth.php Anda 
            // memang tidak ditemukan di folder app/Http/Middleware/
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'check.consent' => \App\Http\Middleware\CheckConsent::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
