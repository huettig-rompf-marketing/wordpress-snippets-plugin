<?php
/**
 * Plugin Name: Hütting & Rompf Marketing Snippets
 * Text Domain: hur-snippets
 * Domain Path: /translations
 * Description: This plugin helps you settings up customized Hüttig & Rompf Marketing Snippets.
 * Version: 1.1.1
 * Requires at least: 5.4
 * Requires PHP: 7.2
 * Author: Hüttig & Rompf
 * Author URI: https://www.huettig-rompf.de
 * License: Apache License 2.0
 * License URI: http://www.apache.org/licenses/LICENSE-2.0
 */

use HuR\Snippets\Plugin;

function main()
{
    require_once __DIR__ . '/src/Plugin.php';

    $plugin = new Plugin();
    $plugin->initialize();
}
main();

//function my_plugin_load_plugin_textdomain() {
//    load_plugin_textdomain( 'hur-snippets', FALSE, basename( dirname( __FILE__ ) ) . '/translations/' );
//}
//add_action( 'plugins_loaded', 'my_plugin_load_plugin_textdomain' );
