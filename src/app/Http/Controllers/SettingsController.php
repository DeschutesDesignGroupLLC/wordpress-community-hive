<?php

namespace CommunityHive\App\Http\Controllers;

use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use CommunityHive\App\Contracts\CommunityHiveUserServiceContract;
use CommunityHive\App\Models\Subscription;
use CommunityHive\App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SettingsController
{
    public function index(CommunityHiveApiServiceContract $apiService, CommunityHiveUserServiceContract $userService): RedirectResponse
    {
        $key = Str::random(40);
        $activateResponse = $apiService->callApi('activate', [
            'site_name' => get_bloginfo('name'),
            'site_url' => site_url(),
            'site_api_url' => site_url('api/community-hive'),
            'site_key' => $key,
            'site_email' => get_bloginfo('admin_email'),
            'site_software' => 'wordpress',
        ]);

        if (isset($activateResponse['error'])) {
            Cache::put('error', Str::title($activateResponse['error']), 60);

            return redirect()->back();
        }

        if (isset($activateResponse['hive_key'], $activateResponse['hive_site_id'])) {
            add_option('community_hive_key', $activateResponse['hive_key']);
            add_option('community_hive_site_key', $key);
            add_option('community_hive_site_id', $activateResponse['hive_site_id']);

            $user = User::find(get_current_user_id());

            Subscription::create([
                'user_id' => $user->getKey(),
            ]);

            $subscribeResponse = $apiService->callApi('subscribe', [
                'site_member_id' => $user->getKey(),
                'group_hash' => $userService->groupHashForUser($user),
                'member_email' => $user->user_email,
            ]);

            if (isset($subscribeResponse['redirect_url'])) {
                return redirect()->to($subscribeResponse['redirect_url']);
            }
        }

        return redirect()->back();
    }

    public function store(): RedirectResponse
    {
        update_option('community_hive_categories', implode(',', request()->input('categories', [])));
        update_option('community_hive_tags', implode(',', request()->input('tags', [])));
        update_option('community_hive_login_page', request()->input('login'));
        update_option('community_hive_registration_page', request()->input('registration'));
        update_option('community_hive_follow_page', request()->input('follow'));

        Cache::put('message', 'Your settings have been successfully saved.', 60);

        return redirect()->back();
    }
}
