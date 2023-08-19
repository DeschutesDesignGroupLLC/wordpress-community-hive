<?php

namespace CommunityHive\App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticateAdmin
{
    /**
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! current_user_can('administrator')) {
            abort(403, 'You must be an administrator to access this page.');
        }

        return $next($request);
    }
}
