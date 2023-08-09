<?php

namespace CommunityHive\App\Providers;

use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use CommunityHive\App\Models\Subscription;
use CommunityHive\App\Models\User;
use CommunityHive\App\Services\CommunityHiveApiService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use WP_User;

class CommunityHiveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CommunityHiveApiServiceContract::class, CommunityHiveApiService::class);

        $this->registerShortcode();
        $this->registerHooks();
        $this->buildAdminControlPanel();
    }

    public function registerShortcode(): void
    {
        add_shortcode('communityhive_promotion', function () {
            return view('shortcodes.plugin');
        });
    }

    public function registerHooks(): void
    {
        register_activation_hook(COMMUNITY_HIVE_PLUGIN_FILE, function () {
            Artisan::call('migrate');
        });

        add_action('set_user_role', function ($id) {
            $apiService = $this->app->make(CommunityHiveApiService::class);
            $apiService->callApi('groupupdate', [
                'site_member_id' => $id,
                'group_hash' => User::find($id)?->groupHash() ?? 'guest',
            ]);
        });

        add_action('delete_user', function ($id, $reassign, WP_User $user) {
            $apiService = $this->app->make(CommunityHiveApiService::class);
            $apiService->callApi('groupupdate', [
                'site_member_id' => $user->ID,
                'group_hash' => 'guest',
            ]);
        });

        add_action('admin_post_community_hive_activate_community', function () {
            $key = Str::random(40);
            $apiService = $this->app->make(CommunityHiveApiService::class);
            $response = $apiService->callApi('activate', [
                'site_name' => get_bloginfo('name'),
                'site_url' => site_url(),
                'site_api_url' => site_url('api/community-hive'),
                'site_key' => $key,
                'site_email' => get_bloginfo('admin_email'),
                'site_software' => 'wordpress',
            ]);

            if (isset($response['hive_key'], $response['hive_site_id'])) {
                Subscription::create([
                    'user_id' => get_current_user_id(),
                ]);

                add_option('community_hive_key', $response['hive_key']);
                add_option('community_hive_site_key', $key);
                add_option('community_hive_site_id', $response['hive_site_id']);
            }

            wp_redirect(admin_url('/admin.php?page=community-hive'));
            exit;
        });
    }

    public function buildAdminControlPanel(): void
    {
        add_action('admin_menu', function () {
            add_menu_page(
                'Community Hive Settings',
                'Community Hive',
                'manage_options',
                'community-hive',
                [$this, 'renderAdminControlPanel']);
        });
    }

    public function renderAdminControlPanel(): Response
    {
        return response()->view('admin.settings', [
            'activated' => get_option('community_hive_site_key') && get_option('community_hive_site_id'),
            'categories' => get_categories(),
        ])->send();
    }
}
