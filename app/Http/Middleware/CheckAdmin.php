<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if ($request->user()->role !='admin') {
            return redirect()->route('account.login');
        }
        
        // Check if user has admin role
        if (auth()->user()->role !== 'admin') {
            session()->flash('error','You are not authorized to access this page.');
            return redirect()->route('home');
        }
        
        return $next($request);
    }
}