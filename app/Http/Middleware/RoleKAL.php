<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleKAL
{
    public function handle(Request $request, Closure $next, string $roles)
    {
        if (! $request->user()) {
            abort(403, 'Unauthorized.');
        }

        $allowedRoles = array_filter(array_map('trim', explode(',', $roles)));

        if (! in_array($request->user()->role, $allowedRoles, true)) {
            abort(403, 'Unauthorized role.');
        }

        return $next($request);
    }
}
