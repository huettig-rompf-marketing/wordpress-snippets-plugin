<?php

namespace HuR\Snippets\Shortcodes;

class SnippetShortcode
{
    public function __invoke($atts, $content)
    {
        $networkSettings = get_site_option('hur_snippets_network_settings', []);
        $siteSettings = get_option('hur_snippets_settings', []);
        $localSettings = json_decode($content, true) ?? [];

        $settings = array_merge(
            $networkSettings,
            $siteSettings,
            json_decode($siteSettings['configuration'] ?? '[]', true) ?? [],
            $localSettings
        );

        $proxyUrl = $settings['proxyUrl'];
        unset($settings['proxyUrl'], $settings['configuration']);

        $url = !empty($proxyUrl) ? rtrim($proxyUrl, '/') : 'https://webhub.huettig-rompf.de';

        return '<script type="text/javascript" src="' . $url . '/js/snippet"></script><script type="application/json" data-huettig-und-rompf-snippet>' . json_encode($settings) . '</script>';
    }
}
