<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedUser
{
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->verified) {
            return redirect('/dashboard')
                ->with('error', 'Account not verified yet.');
        }
        return $next($request);
    }

}
