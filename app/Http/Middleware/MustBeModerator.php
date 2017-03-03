<?php

namespace App\Http\Middleware;

use Closure;

class MustBeModerator
{

    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ($user && $user->isMod()) {
            return $next($request);
        }
        return response('You are not a moderator.', 401);
    }

}