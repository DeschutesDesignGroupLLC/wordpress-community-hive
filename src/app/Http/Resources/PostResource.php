<?php

namespace CommunityHive\App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
