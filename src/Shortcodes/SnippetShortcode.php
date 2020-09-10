<?php

namespace HuR\Snippets\Shortcodes;

class SnippetShortcode
{
    protected static $javascriptWasIncluded = false;
    public function __invoke($atts, $content)
    {
        $networkSettings = get_site_option('hur_snippets_network_settings', []);
        $siteSettings = get_option('hur_snippets_settings', []);

        $siteSettings['configuration'] = json_decode($siteSettings['configuration'] ?? '[]', true) ?? [];
        $settings = $this->mergeRecursive($networkSettings, $siteSettings);

        $snippetSettings = $this->mergeRecursive($siteSettings['configuration'], @json_decode($content, true) ?? []);

        $result = '';
        if(!static::$javascriptWasIncluded){
            static::$javascriptWasIncluded = true;
            $url = !empty($settings['proxyUrl']) ? rtrim($settings['proxyUrl'], '/') : 'https://webhub.huettig-rompf.de';
            $result.= '<script type="text/javascript" src="' . $url . '/js/snippet"></script>';
        }

        $result .= '<div class="alignwide">' .
                       '<script type="application/json" data-huettig-und-rompf-snippet>' .
                            json_encode($snippetSettings) .
                       '</script>' .
                   '</div>';

        return $result;
    }

    /**
     * Internal helper to recursively merge the configurations with overrides
     * @param   array  $a
     * @param   array  $b
     *
     * @return array
     */
    protected function mergeRecursive(array $a, array $b): array{
        $c = $a;
        foreach ($b as $k => $v){
            if(is_array($v) && isset($a[$k]) && is_array($a[$k])){
                $c[$k] = $this->mergeRecursive($a[$k], $v);
            } else {
                $c[$k] = $v;
            }
        }
        return $c;
    }
}
