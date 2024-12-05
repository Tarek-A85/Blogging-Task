<?php

use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckUserMiddleware;
use App\Http\Middleware\LanguageMiddleware;
use App\Http\Middleware\NoAdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'app_lang' => LanguageMiddleware::class,
            'check_admin' => CheckAdminMiddleware::class,
            'check_user' => CheckUserMiddleware::class,
            'no_admin' => NoAdminMiddleware::class

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
