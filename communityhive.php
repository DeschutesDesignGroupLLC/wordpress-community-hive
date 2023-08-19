<?php
/**
 * Plugin Name: Community Hive
 * Author: Community Hive
 * Author URI: https://www.communityhive.com
 * Description: Community Hive allows your members to follow their favorite communities to receive updates.
 * Version: 1.0.0
 * Requires PHP: 8.1
 */

use Roots\Acorn\Bootloader;

/**
 * Set constants
 */
\define('WP_ENV', 'development');
\define('ACORN_BASEPATH', rtrim(plugin_dir_path(__FILE__).'src', '/'));
\define('COMMUNITY_HIVE_BASE_URL', 'host.docker.internal:3000/');
\define('COMMUNITY_HIVE_PLUGIN_VERSION', '1.0.0');
\define('COMMUNITY_HIVE_PLUGIN_FILE', __FILE__);
\define('COMMUNITY_HIVE_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Experimental features
 */
putenv('ACORN_ENABLE_EXPIRIMENTAL_ROUTER=true');

/**
 * Require dependencies
 */
require_once plugin_dir_path(__FILE__).'vendor/autoload.php';

/**
 * Boot Acorns
 */
$instance = Bootloader::getInstance();
$instance->boot();