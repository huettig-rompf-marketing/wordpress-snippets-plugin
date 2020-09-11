<?php

namespace HuR\Snippets\Admin;

use HuR\Snippets\Admin\Controllers\NetworkSettingsController;
use HuR\Snippets\Admin\Controllers\SiteSettingsController;

class Admin
{
    public function initialize()
    {
        $this->registerControllers();
        $this->enqueueAssets();
    }

    public function registerControllers()
    {
        add_action('admin_menu', [$this, 'registerSiteSettingsController']);
        add_action('network_admin_menu', [$this, 'registerNetworkSettingsController']);
    }

    public function enqueueAssets()
    {
        add_action('admin_enqueue_scripts', function ($hook) {
            if ('settings_page_huetting-rompf-snippet-settings' === $hook) {
                wp_enqueue_script(
                    md5_file(HUR_SNIPPETS_ASSETS_DIR . '/bundle/admin.js'),
                    HUR_SNIPPETS_ASSETS_URL . '/bundle/admin.js'
                );

                wp_enqueue_style(
                    md5_file(HUR_SNIPPETS_ASSETS_DIR . '/bundle/css/admin.css'),
                    HUR_SNIPPETS_ASSETS_URL . '/bundle/css/admin.css'
                );
            }
        });
    }

    public function registerSiteSettingsController()
    {
        add_submenu_page(
            'options-general.php',
            __('Hütting & Rompf Snippet Settings', 'hur-snippets'),
            __('Hütting & Rompf Snippet Settings', 'hur-snippets'),
            'manage_options',
            'huetting-rompf-snippet-settings',
            new SiteSettingsController()
        );
    }

    public function registerNetworkSettingsController()
    {
        add_submenu_page(
            'settings.php',
            __('Hütting & Rompf Snippet Settings', 'hur-snippets'),
            __('Hütting & Rompf Snippet Settings', 'hur-snippets'),
            'manage_options',
            'huetting-rompf-snippet-settings',
            new NetworkSettingsController()
        );
    }
}
