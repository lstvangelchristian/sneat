<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthorAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('author')->check()) {
            return redirect()->route('show-blog');
        }

        return $next($request);
    }
}
