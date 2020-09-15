<?php

namespace HuR\Snippets;

use HuR\Snippets\Admin\Admin;

class Plugin
{
    public function initialize(): void
    {
        $this->registerAutoloader();
        $this->registerTextdomain();

        if(is_user_logged_in()){
            $admin = new Admin();
            $admin->initialize();
        }

        $shortcodes = new Shortcodes();
        $shortcodes->register();
    }

    public function registerTextdomain(): void
    {
        $relPath = str_replace(dirname(HUR_SNIPPETS_PLUGIN_DIR), '', HUR_SNIPPETS_TRANSLATION_DIR);
        load_plugin_textdomain('hur-snippets', false, $relPath);
    }

    protected function registerAutoloader(): void
    {
        require_once __DIR__ . '/Autoloader.php';

        $autoloader = new Autoloader();
        $autoloader->register('HuR\\Snippets\\', HUR_SNIPPETS_SRC_DIR);
    }
}
