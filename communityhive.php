<?php
/**
 * Plugin Name: Community Hive
 * Author: Community Hive
 * Author URI: https://www.communityhive.com
 * Description: Community Hive allows your members to follow their favorite communities to receive updates.
 * Version: 1.0.1
 * Requires PHP: 8.1
 */

use Dotenv\Dotenv;
use Roots\Acorn\Bootloader;
use Roots\WPConfig\Config;

/**
 * Require dependencies
 */
require_once plugin_dir_path(__FILE__).'vendor/autoload.php';

/**
 * Load env vars
 */
$dotenv = Dotenv::createUnsafeImmutable(__DIR__.'/src', '.env', false);
if (file_exists(__DIR__ . '/src/.env')) {
    $dotenv->load();
}

/**
 * Set up configuration
 */
Config::define('ACORN_BASEPATH', rtrim(plugin_dir_path(__FILE__).'src', '/'));
Config::define('WP_ENV', env('APP_ENV', 'production'));
Config::define('COMMUNITY_HIVE_BASE_URL', env('COMMUNITY_HIVE_BASE_URL', 'https://www.communityhive.com/api/v1/'));
Config::define('COMMUNITY_HIVE_PLUGIN_VERSION', '1.0.1');
Config::define('COMMUNITY_HIVE_PLUGIN_FILE', __FILE__);
Config::define('COMMUNITY_HIVE_PLUGIN_URL', plugin_dir_url(__FILE__));
Config::apply();

/**
 * Acorn configuration
 */
putenv('APP_RUNNING_IN_CONSOLE=false');
putenv('ACORN_ENABLE_EXPIRIMENTAL_ROUTER=true');

/**
 * Boot Acorns
 */
$instance = Bootloader::getInstance();
$instance->boot();