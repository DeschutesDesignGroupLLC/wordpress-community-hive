<?php

namespace CommunityHive\App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\JsonResponse;

class OkayResponse implements Responsable
{
    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'message' => 'ok',
        ]);
    }
}
