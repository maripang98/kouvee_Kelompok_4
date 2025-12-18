<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',           // ← WAJIB ADA
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php', // ← WAJIB ADA
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // middleware global (jika ada)
        $middleware->append(\App\Http\Middleware\CorsMiddleware::class);

        // middleware alias (PENTING)
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
