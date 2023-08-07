<?php

namespace CommunityHive\App\Http\Controllers\Api;

use Illuminate\Routing\Controller;

class PostsController extends Controller
{
    public function index()
    {
        return response()->json(get_posts());
    }
}