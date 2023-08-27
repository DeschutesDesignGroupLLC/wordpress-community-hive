<?php

namespace CommunityHive\App\Http\Controllers;

use CommunityHive\App\Contracts\CommunityHiveUserServiceContract;
use CommunityHive\App\Http\Responses\ContentResponse;
use CommunityHive\App\Http\Responses\ErrorResponse;
use CommunityHive\App\Http\Responses\OkayResponse;
use CommunityHive\App\Http\Responses\SyncUsersResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function index(CommunityHiveUserServiceContract $userService): ContentResponse|SyncUsersResponse|OkayResponse|ErrorResponse
    {
        switch (request()->input('payload.request_type')) {
            case 'content':
                return app()->make(ContentResponse::class);

            case 'sync':
                return app()->make(SyncUsersResponse::class, [
                    'data' => $userService->syncUsers(request()->input('payload.data')),
                ]);

            case 'unfollow':
                $userService->unfollowUser(request()->input('payload.member_id'));

                return app()->make(OkayResponse::class);

            default:
                return app()->make(ErrorResponse::class, [
                    'message' => 'The provided request type is invalid.',
                ]);
        }
    }

    /**
     * @throws BindingResolutionException
     */
    public function show(): ErrorResponse|RedirectResponse
    {
        if ($item = request()->input('click')) {
            $decoded = base64_decode($item);
            parse_str($decoded, $id);

            if (isset($id['key1']) && $url = get_permalink((int) $id['key1'])) {
                return redirect()->to($url);
            }

            return app()->make(ErrorResponse::class, [
                'message' => 'We are unable to redirect you to the post.',
            ]);
        }

        if (request()->input('follow') === '1') {
            return redirect()->route('follow.index');
        }

        return redirect()->to(site_url());
    }
}
