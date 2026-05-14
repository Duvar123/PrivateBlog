<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        if (! $user || optional($user->role)->nombre !== 'Administrador') {
            abort(403, 'Solo administradores pueden acceder a esta sección.');
        }

        return $next($request);
    }
}
