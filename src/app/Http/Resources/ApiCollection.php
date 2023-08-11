<?php

namespace CommunityHive\App\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public static $wrap = 'results';

    public function toArray($request): AnonymousResourceCollection
    {
        return PostResource::collection($this->collection);
    }
}
