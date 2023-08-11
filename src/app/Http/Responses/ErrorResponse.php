<?php

namespace CommunityHive\App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\JsonResponse;

class ErrorResponse implements Responsable
{
    public function __construct(protected string $message)
    {
        //
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'error' => $this->message,
        ]);
    }
}
