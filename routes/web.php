<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Account Related Routes
Route::group(['prefix' => 'account'], function () {

    // Guest Routes: Only accessible when NOT logged in
    Route::middleware('guest')->group(function () {
        
        Route::get('/register', [AccountController::class, 'registration'])->name('account.registration');
        Route::post('/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');

    });

    // Authenticated Routes: Only accessible when LOGGED IN
    Route::middleware('auth')->group(function () {
        
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');

    });

});