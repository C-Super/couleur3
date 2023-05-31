<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FillEndedAtField
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('post') && !$request->filled('ended_at')) {
            $request->merge(['ended_at' => now()->addMinutes(20)->format('Y-m-d H:i:s')]);
        }

        return $next($request);
    }
}
