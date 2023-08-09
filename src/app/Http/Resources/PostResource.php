<?php

namespace CommunityHive\App\Http\Resources;

use CommunityHive\App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->post_title,
            'content' => trim(Str::replace(['<!-- wp:paragraph -->', '<!-- /wp:paragraph -->'], '', $this->post_content)),
            'date' => Carbon::parse($this->post_date)->getTimestamp(),
            'author' => User::find($this->post_author)?->display_name,
            'key1' => $this->ID,
            'key2' => null,
            'replies' => $this->comment_count,
            'reactions' => null,
            'image' => null,
        ];
    }
}
