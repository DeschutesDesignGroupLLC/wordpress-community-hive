<?php

namespace CommunityHive\App\Providers;

use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use CommunityHive\App\Services\CommunityHiveApiService;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use WP_Post;
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
        add_action('delete_post', function ($id, WP_Post $post) {
            $apiService = $this->app->make(CommunityHiveApiService::class);
            $apiService->callApi('');
        });

        add_action('delete_user', function ($id, $reassign, WP_User $user) {
            $apiService = $this->app->make(CommunityHiveApiService::class);
            $apiService->callApi('');
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
        return response()->view('admin.settings')->send();
    }
}
