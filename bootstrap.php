<?php

use Roots\Acorn\Bootloader;

\define('ACORN_BASEPATH', __DIR__ . '/src');
\define('WP_DEBUG_DISPLAY', true);
\define('DB_HOST', 'mysql');
\define('DB_NAME', 'wordpress');
\define('DB_USER', 'wordpress');
\define('DB_PASSWORD', 'wordpress');
\define('WP_CONTENT_DIR', '');

require_once __DIR__ . '/vendor/autoload.php';

$instance = Bootloader::getInstance();
$instance->boot();