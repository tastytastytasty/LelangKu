<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.masyarakat' => \App\Http\Middleware\AuthMasyarakat::class,
            'auth.petugas' => \App\Http\Middleware\AuthPetugas::class,
            'guest.only' => \App\Http\Middleware\UdhLogin::class,
            'auth.only' => \App\Http\Middleware\BlmLogin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
