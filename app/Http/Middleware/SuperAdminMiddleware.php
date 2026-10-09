<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {

        if (!auth()->check()) {

            return redirect()
                ->route('login');

        }


        if (!auth()->user()->activo) {

            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Tu cuenta se encuentra desactivada.'
                ]);

        }


        if (!auth()->user()->esSuperAdmin()) {

            abort(403);
        }


        return $next($request);
    }
}