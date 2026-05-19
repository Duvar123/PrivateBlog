<?php

namespace App\Http\Middleware;

use App\Helpers\RolHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorizedMiddleware
{
    public function handle(Request $request, Closure $next, $permission = null): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!empty($permission)) {
            if (!RolHelper::isAuthorized($permission)) {
                abort(403, 'No hay autorización');
            }
        }

        return $next($request);
    }
}
