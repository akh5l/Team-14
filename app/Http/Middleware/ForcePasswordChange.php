<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if ($request->user() && $request->user()->force_password_change) {
            if (!$request->is('password/change')) {
                    return redirect()->route('admin.password.update');
            }
        }

        return $next($request);
    }
}
