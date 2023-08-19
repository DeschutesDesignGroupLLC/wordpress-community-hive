<?php

namespace CommunityHive\App\Http\Middleware;

use Closure;
use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticateJwt
{
    /**
     * @return JsonResponse|mixed
     *
     * @throws BindingResolutionException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! $token = $request->getContent()) {
            return response()->json([
                'error' => 'There was no JWT included in the request.',
            ]);
        }

        $apiService = app()->make(CommunityHiveApiServiceContract::class);
        if (! $payload = $apiService->decodeJwt($token)) {
            return response()->json([
                'error' => 'Unable to decode the provided JWT.',
            ]);
        }

        $request->mergeIfMissing([
            'payload' => $payload,
        ]);

        return $next($request);
    }
}
