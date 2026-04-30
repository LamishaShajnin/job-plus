<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // First, check if user is logged in
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        
        if (!Auth::check()) {
            return redirect()->route('account.login');
        }
        
        // Second, check if logged-in user has admin role
        if ($user && $user->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You do not have admin access.');
        }
        
        // If both checks pass, allow access
        return $next($request);
    }
}