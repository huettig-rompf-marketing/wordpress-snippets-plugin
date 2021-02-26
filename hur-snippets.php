<?php
/**
 * Plugin Name: Hütting & Rompf Marketing Snippets
 * Text Domain: hur-snippets
 * Domain Path: /translations
 * Description: This plugin helps you settings up customized Hüttig & Rompf Marketing Snippets.
 * Version: 1.3.1
 * Requires at least: 5.4
 * Requires PHP: 7.2
 * Author: Hüttig & Rompf
 * Author URI: https://www.huettig-rompf.de
 * License: Apache License 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */

use HuR\Snippets\Plugin;

require_once __DIR__ . '/src/Plugin.php';

define('HUR_SNIPPETS_PRIMARY_COLOR', '#004f9f');
define('HUR_SNIPPETS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('HUR_SNIPPETS_PLUGIN_URL', rtrim(plugin_dir_url(HUR_SNIPPETS_PLUGIN_DIR . '/hur-snippets.php'), '/'));
define('HUR_SNIPPETS_ASSETS_DIR', HUR_SNIPPETS_PLUGIN_DIR . '/assets');
define('HUR_SNIPPETS_ASSETS_URL', HUR_SNIPPETS_PLUGIN_URL . '/assets');
define('HUR_SNIPPETS_SRC_DIR', HUR_SNIPPETS_PLUGIN_DIR . '/src');
define('HUR_SNIPPETS_TEMPLATE_DIR', HUR_SNIPPETS_PLUGIN_DIR . '/templates');
define('HUR_SNIPPETS_TRANSLATION_DIR', HUR_SNIPPETS_PLUGIN_DIR . '/translations');

$plugin = new Plugin();

add_action('plugins_loaded', function () use($plugin){
    $plugin->registerTextdomain();
});

add_action('init', static function() use($plugin){
    $plugin->initialize();
});
