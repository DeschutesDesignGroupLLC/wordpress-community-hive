<?php

namespace CommunityHive\App\Providers;

use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use CommunityHive\App\Contracts\CommunityHiveUserServiceContract;
use CommunityHive\App\Models\Subscription;
use CommunityHive\App\Models\User;
use CommunityHive\App\Services\CommunityHiveApiService;
use CommunityHive\App\Services\CommunityHiveUserService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use WP_User;

class CommunityHiveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CommunityHiveApiServiceContract::class, CommunityHiveApiService::class);
        $this->app->bind(CommunityHiveUserServiceContract::class, CommunityHiveUserService::class);

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
        register_activation_hook(COMMUNITY_HIVE_PLUGIN_FILE, [$this, 'activationRoutine']);
        register_uninstall_hook(COMMUNITY_HIVE_PLUGIN_FILE, [CommunityHiveServiceProvider::class, 'uninstallRoutine']);

        add_action('init', [$this, 'pluginInitiated']);

        add_action('set_user_role', function ($id) {
            $userService = $this->app->make(CommunityHiveUserService::class);
            $apiService = $this->app->make(CommunityHiveApiService::class);
            $apiService->callApi('groupupdate', [
                'site_member_id' => $id,
                'group_hash' => $userService->groupHashForUser(User::find($id)),
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
            $userService = $this->app->make(CommunityHiveUserService::class);
            $apiService = $this->app->make(CommunityHiveApiService::class);
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

                wp_redirect(admin_url('/admin.php?page=community-hive'));
                exit;
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
                    wp_redirect($subscribeResponse['redirect_url']);
                    exit;
                }
            }

            wp_redirect(admin_url('/admin.php?page=community-hive'));
            exit;
        });

        add_action('admin_post_community_hive_save_settings', function () {
            update_option('community_hive_categories', implode(',', request()->get('categories', [])));
            update_option('community_hive_tags', implode(',', request()->get('tags', [])));

            wp_redirect(admin_url('/admin.php?page=community-hive'));
            exit;
        });
    }

    public function pluginInitiated(): void
    {
        //
    }

    public function activationRoutine(): void
    {
        Artisan::call('migrate', ['--force' => true]);
        Log::debug(Artisan::output());
    }

    public static function uninstallRoutine(): void
    {
        Schema::drop('communityhive_migrations');
        Schema::drop('communityhive_subscriptions');

        delete_option('community_hive_key');
        delete_option('community_hive_site_key');
        delete_option('community_hive_site_id');
        delete_option('community_hive_categories');
        delete_option('community_hive_tags');
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
            'categories' => get_categories(['hide_empty' => false]),
            'categories_selected' => explode(',', get_option('community_hive_categories')),
            'tags' => get_tags(['hide_empty' => false]),
            'tags_selected' => explode(',', get_option('community_hive_tags')),
        ])->send();
    }
}
