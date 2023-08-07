<?php
/**
 * Plugin Name: Community Hive
 * Author: Invision Power Services, Inc.
 * Author URI: https://www.invisioncommunity.com
 * Description: Community Hive allows your members to follow their favorite communities to receive updates.
 * Version: 1.0.0
 */

use Roots\Acorn\Bootloader;

/**
 * Set constants
 */
\define('WP_ENV', 'local');
\define('ACORN_BASEPATH', rtrim(plugin_dir_path(__FILE__).'src', '/'));

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