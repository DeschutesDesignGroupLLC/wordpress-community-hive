<?php

namespace CommunityHive\App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiCollection extends ResourceCollection
{
    /**
     * @var string
     */
    public static $wrap = 'results';

    public function toArray($request)
    {
        return PostResource::collection($this->collection);
    }
}
