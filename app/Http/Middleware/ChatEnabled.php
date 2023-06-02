<?php

namespace App\Http\Middleware;

use App\Settings\GeneralSettings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class ChatEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! app(GeneralSettings::class)->is_chat_enabled) {
            throw ValidationException::withMessages([
                'message' => 'Vous ne pouvez pas envoyé de message quand le chat est désactivé.',
            ]);
        }

        return $next($request);
    }
}
