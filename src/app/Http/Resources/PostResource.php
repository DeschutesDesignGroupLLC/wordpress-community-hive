<?php

namespace CommunityHive\App\Http\Resources;

use CommunityHive\App\Models\Post;
use CommunityHive\App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @mixin Post
 */
class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        $post = [
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

        if ($imageUrl = get_the_post_thumbnail_url($this->ID)) {
            $contents = file_get_contents($imageUrl);

            if ($contents) {
                $thumbnail = DB::table('postmeta')
                    ->select('meta_value')
                    ->where('post_id', '=', get_post_thumbnail_id($this->ID))
                    ->where('meta_key', '=', '_wp_attached_file')
                    ->first();

                $post['image'] = [
                    'name' => $thumbnail->meta_value ?? null,
                    'file' => base64_encode($contents),
                ];
            }
        }

        return $post;
    }
}
