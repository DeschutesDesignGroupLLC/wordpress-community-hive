<?php

namespace CommunityHive\App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticateUser
{
    /**
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! is_user_logged_in()) {
            abort(403, 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
