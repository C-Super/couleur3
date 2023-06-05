<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAsAuditor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()->isAuditor()) {
            return Inertia::render('Error', [
                'status' => '403: '.__('http-statuses.403'),
                'message' => "Vous n'êtes pas un auditeur.",
            ])->toResponse($request)->setStatusCode(403);
        }

        return $next($request);
    }
}
