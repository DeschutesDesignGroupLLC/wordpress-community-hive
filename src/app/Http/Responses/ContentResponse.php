<?php

namespace CommunityHive\App\Http\Responses;

use CommunityHive\App\Http\Resources\ApiCollection;
use CommunityHive\App\Models\Post;
use Illuminate\Contracts\Support\Responsable;

class ContentResponse implements Responsable
{
    public function toResponse($request): ApiCollection
    {
        return new ApiCollection(Post::forCommunityHive()->get());
    }
}
