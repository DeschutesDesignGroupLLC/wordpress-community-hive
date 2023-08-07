<?php

namespace WordpressPluginTemplate\App\Providers;

use Illuminate\Support\ServiceProvider;

class CommunityHiveServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerShortcode();
    }

    public function registerShortcode()
    {
        add_shortcode('communityhive_shortcode', function () {
            return view('shortcodes.plugin');
        });
    }
}
