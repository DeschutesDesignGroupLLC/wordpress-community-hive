<?php

namespace CommunityHive\App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\JsonResponse;

class SyncUsersResponse implements Responsable
{
    public function __construct(protected ?array $data = [])
    {
        //
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json($this->data);
    }
}
