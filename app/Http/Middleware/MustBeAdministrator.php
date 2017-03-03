<?php

namespace App\Http\Middleware;

use Closure;

class MustBeAdministrator
{

    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->isAdmin()) {
            return $next($request);
        }
        return response('You are not an administrator.', 401);
    }

}