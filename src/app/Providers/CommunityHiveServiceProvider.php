<?php

namespace CommunityHive\App\Providers;

use CommunityHive\App\Contracts\CommunityHiveApiServiceContract;
use CommunityHive\App\Contracts\CommunityHiveUserServiceContract;
use CommunityHive\App\Models\User;
use CommunityHive\App\Services\CommunityHiveApiService;
use CommunityHive\App\Services\CommunityHiveUserService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;
use WP_User;

use function Roots\bundle;
use function Roots\view;

class CommunityHiveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CommunityHiveApiServiceContract::class, CommunityHiveApiService::class);
        $this->app->bind(CommunityHiveUserServiceContract::class, CommunityHiveUserService::class);

        $this->registerHooks();
        $this->registerShortcodes();
        $this->buildAdminControlPanel();
    }

    public function registerShortcodes(): void
    {
        add_shortcode('community_hive_follow', function () {
            bundle('shortcode')->enqueueCss();

            return view('shortcodes.follow', [
                'loggedIn' => is_user_logged_in(),
                'user' => wp_get_current_user(),
                'community' => get_bloginfo('name'),
            ]);
        });

        add_shortcode('community_hive_widget', function () {
            return 'Hello, World!';
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
        }, 10, 3);
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
        delete_option('community_hive_login_page');
        delete_option('community_hive_registration_page');
        delete_option('community_hive_follow_page');
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
            'followPageSet' => get_option('community_hive_follow_page'),
            'activated' => get_option('community_hive_site_key') && get_option('community_hive_site_id'),
            'categories' => get_categories(['hide_empty' => false]),
            'tags' => get_tags(['hide_empty' => false]),
            'pages' => get_pages(),
        ])->send();
    }
}
