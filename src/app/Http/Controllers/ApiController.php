<?php

namespace CommunityHive\App\Http\Controllers;

use CommunityHive\App\Http\Resources\ApiCollection;
use CommunityHive\App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    public function index(): ApiCollection|JsonResponse
    {
        $type = request()->get('request_type');

        return match ($type) {
            'sync' => response()->json([
                'test' => 'test',
            ]),
            default => new ApiCollection(Post::forCommunityHive()->get())
        };
    }

    public function show(): JsonResponse|RedirectResponse
    {
        if ($item = request()->get('click')) {
            $decoded = base64_decode($item);
            parse_str($decoded, $id);

            if (isset($id['key1']) && $url = get_permalink($id['key1'])) {
                return response()->redirectTo($url);
            }

            return response()->json([
                'error' => 'Unable to redirect to post',
            ]);
        }

        return response()->redirectTo(site_url());
    }
}
