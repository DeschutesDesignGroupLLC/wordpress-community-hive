<?php

namespace CommunityHive\App\Http\Controllers;

use CommunityHive\App\Http\Resources\PostResource;
use CommunityHive\App\Models\Post;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    public function index()
    {
        $type = request()->get('request_type');

        return match ($type) {
            'sync' => response()->json([
                'test' => 'test',
            ]),
            default => PostResource::collection(Post::forCommunityHive()->get())
        };
    }

    public function show($url = null)
    {
        $item = json_decode(base64_decode(urldecode($url)), true);

        dd($item);
    }
}
