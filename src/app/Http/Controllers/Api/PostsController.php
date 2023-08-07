<?php

namespace CommunityHive\App\Http\Controllers\Api;

use CommunityHive\App\Http\Resources\PostResource;
use CommunityHive\App\Models\Post;
use Illuminate\Routing\Controller;

class PostsController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::all());
    }
}
