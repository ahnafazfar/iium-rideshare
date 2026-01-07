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

    public function create()
    {
        if (!auth()->user()->verified) {
            return redirect()->route('rides.index')->with('error', 'You must be verified to post a ride.');
        }
        return view('rides.create');
    }

}
