<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }
        $role = auth()->user()->role;
        if(!in_array($role,$roles)){
            abort(403, 'User not authenticated');
        }
        return $next($request);
    }
}
