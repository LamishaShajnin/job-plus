<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/account/register',[AccountController::class,'registration'])->name('account.registration');
Route::post('/account/process-register',[AccountController::class,'processRegistration'])->name('account.processRegistration');
Route::get('/account/login',[AccountController::class,'login'])->name('account.login');

Route::post('/account/authenticate',[AccountController::class,'authenticate'])->name('account.authenticate');
Route::post('/account/profile',[AccountController::class,'index'])->name('account.profile');