<?php

namespace CommunityHive\App\Http\Middleware;

use Closure;
use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use CommunityHive\App\Http\Responses\ErrorResponse;
use CommunityHive\App\Http\Responses\OkayResponse;
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
        if ($request->input('request_type') === 'test') {
            return app()->make(OkayResponse::class);
        }

        if (! $token = $request->getContent()) {
            return app()->make(ErrorResponse::class, [
                'message' => 'There was no JWT included in the request.',
            ]);
        }

        $apiService = app()->make(CommunityHiveApiServiceContract::class);
        if (! $payload = $apiService->decodeJwt($token)) {
            return app()->make(ErrorResponse::class, [
                'message' => 'Unable to decode the provided JWT.',
            ]);
        }

        $request->mergeIfMissing([
            'payload' => $payload,
        ]);

        return $next($request);
    }
}
