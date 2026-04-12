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
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. If a user is NOT logged in and hits a protected route, 
        // redirect them to your custom login page.
        $middleware->redirectGuestsTo(fn () => route('account.login'));

        // 2. If a user IS already logged in and tries to visit the login 
        // or register page, redirect them to their profile.
        $middleware->redirectUsersTo(fn () => route('account.profile'));

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();