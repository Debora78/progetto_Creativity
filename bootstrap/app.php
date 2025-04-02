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
    //!Registrato il nostro middleware custom inserendo un array middleware specificando il loro alias come chiave e il percorso del middleware che vogliamo registrare come valore. Questo middleware è disponibile ed utilizzabile all'interno del nostro progetto
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin'=>App\Http\Middleware\UserIsAdmin::class,
            'revisor'=>App\Http\Middleware\UserIsRevisor::class
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
