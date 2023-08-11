<?php

namespace CommunityHive\App\Http\Controllers;

use CommunityHive\App\Contracts\CommunityHiveUserServiceContract;
use CommunityHive\App\Http\Responses\ContentResponse;
use CommunityHive\App\Http\Responses\ErrorResponse;
use CommunityHive\App\Http\Responses\OkayResponse;
use CommunityHive\App\Http\Responses\SyncUsersResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    public function index(CommunityHiveUserServiceContract $userService): ContentResponse|SyncUsersResponse|OkayResponse|ErrorResponse
    {
        switch (request()->get('request_type')) {
            case 'content':
                return app()->make(ContentResponse::class);

            case 'sync':
                return app()->make(SyncUsersResponse::class, [
                    'data' => $userService->syncUsers(request()->get('sync_data')),
                ]);

            case 'unfollow':
                $userService->unfollowUser(request()->get('member_id'));

                return app()->make(OkayResponse::class);

            default:
                return app()->make(ErrorResponse::class, [
                    'message' => 'Invalid request type',
                ]);
        }
    }

    public function show(): ErrorResponse|RedirectResponse
    {
        if ($item = request()->get('click')) {
            $decoded = base64_decode($item);
            parse_str($decoded, $id);

            if (isset($id['key1']) && $url = get_permalink($id['key1'])) {
                return response()->redirectTo($url);
            }

            return app()->make(ErrorResponse::class, [
                'message' => 'Unable to redirect to post',
            ]);
        }

        return response()->redirectTo(site_url());
    }
}
