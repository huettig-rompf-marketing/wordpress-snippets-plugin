<?php

namespace HuR\Snippets;

use HuR\Snippets\Admin\Admin;

class Plugin
{
    public function initialize(): void
    {
        $this->constants();
        $this->registerAutoloader();
        $this->registerTextdomain();

        if(is_user_logged_in()){
            $admin = new Admin();
            $admin->initialize();
        }

        $shortcodes = new Shortcodes();
        $shortcodes->register();
    }

    protected function constants(): void
    {
        define('HUR_SNIPPETS_PLUGIN_DIR', dirname(plugin_dir_path(__FILE__)));
        define('HUR_SNIPPETS_PLUGIN_URL', rtrim(plugin_dir_url(HUR_SNIPPETS_PLUGIN_DIR . '/hur-snippets.php'), '/'));
        define('HUR_SNIPPETS_ASSETS_DIR', HUR_SNIPPETS_PLUGIN_DIR . '/assets');
        define('HUR_SNIPPETS_ASSETS_URL', HUR_SNIPPETS_PLUGIN_URL . '/assets');
        define('HUR_SNIPPETS_SRC_DIR', HUR_SNIPPETS_PLUGIN_DIR . '/src');
        define('HUR_SNIPPETS_TEMPLATE_DIR', HUR_SNIPPETS_PLUGIN_DIR . '/templates');
        define('HUR_SNIPPETS_TRANSLATION_DIR', HUR_SNIPPETS_PLUGIN_DIR . '/translations');
    }

    protected function registerAutoloader(): void
    {
        require_once __DIR__ . '/Autoloader.php';

        $autoloader = new Autoloader();
        $autoloader->register('HuR\\Snippets\\', HUR_SNIPPETS_SRC_DIR);
    }

    protected function registerTextdomain(): void
    {
        add_action('plugins_loaded', function () {
            $relPath = str_replace(dirname(HUR_SNIPPETS_PLUGIN_DIR), '', HUR_SNIPPETS_TRANSLATION_DIR);
            load_plugin_textdomain('hur-snippets', false, $relPath);
        });
    }
}
