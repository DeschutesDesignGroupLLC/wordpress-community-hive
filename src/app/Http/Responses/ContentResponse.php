<?php

namespace CommunityHive\App\Http\Responses;

use CommunityHive\App\Http\Resources\ApiCollection;
use CommunityHive\App\Models\Post;
use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class ContentResponse implements Responsable
{
    public function toResponse($request): Response
    {
        return \response()->json([
            'results' => new ApiCollection(Post::forCommunityHive()->get()),
        ]);
    }
}
