<?php

namespace CommunityHive\App\Http\Controllers;

use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use CommunityHive\App\Contracts\CommunityHiveUserServiceContract;
use CommunityHive\App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class FollowController
{
    public function index($action, CommunityHiveApiServiceContract $apiService): RedirectResponse
    {
        switch ($action) {
            case 'register':
                $register = get_option('community_hive_registration_page');

                return redirect()->to($register !== '' ? get_permalink($register) : wp_registration_url());

            case 'login':
                $login = get_option('community_hive_login_page');

                return redirect()->to($login !== '' ? get_permalink($login) : wp_login_url());

            case 'follow':
                $response = $apiService->callApi('subscribe', [
                    'site_member_id' => 0,
                    'group_hash' => 'guest',
                    'member_email' => false,
                ]);

                if (isset($response['redirect_url'])) {
                    return redirect()->to($response['redirect_url']);
                }
        }

        return redirect()->to(site_url());
    }

    public function store(CommunityHiveApiServiceContract $apiService, CommunityHiveUserServiceContract $userService): RedirectResponse
    {
        $user = User::query()->where('user_email', '=', request()->input('email'))->first();

        if ($user) {
            $response = $apiService->callApi('subscribe', [
                'site_member_id' => $user->getKey(),
                'group_hash' => $userService->groupHashForUser($user),
                'member_email' => $user->user_email,
            ]);

            if (isset($response['redirect_url'])) {
                return redirect()->to($response['redirect_url']);
            }
        }

        Cache::put('error', 'Unable to find a user account associated with that email.', 60);

        return redirect()->back();
    }
}
