<?php

namespace HuR\Snippets\Shortcodes;

use HuR\Snippets\Helper;
use function GuzzleHttp\Psr7\str;

class SnippetShortcode implements ShortCodeInterface
{
    /**
     * True if the javascript was already injected into the page
     * @var bool
     */
    protected $javascriptWasIncluded = false;

    /**
     * Holds the site settings after they have been generated in getSiteSettings()
     * @var array
     */
    protected $siteSettings;

    public function render(?array $attr, string $content): string
    {
        $snippetSettings = $this->mergeRecursive(
            $this->buildDynamicSnippetConfiguration($this->getSiteSettings(), $attr ?? []),
            @json_decode($content, true) ?? []
        );

        return $this->buildScriptTagIfRequired() .
               '<div class="alignwide">' .
               '<script type="application/json" data-huettig-und-rompf-snippet>' .
               json_encode($snippetSettings) .
               '</script>' .
               '</div>';
    }

    /**
     * Returns the combined settings based on the network and the site configuration
     * NOTE: The site configuration wins over the network configuration
     * @return array
     */
    protected function getSiteSettings(): array{
        if(isset($this->siteSettings)) {
            return $this->siteSettings;
        }

        $networkSettings = get_site_option('hur_snippets_network_settings', []);
        $siteSettings = get_option('hur_snippets_settings', []);
        $siteSettings['configuration'] = json_decode($siteSettings['configuration'] ?? '[]', true) ?? [];

        return $this->siteSettings = $this->mergeRecursive($networkSettings, $siteSettings);
    }

    /**
     * Builds the javascript include tag if the js was not already loaded on the page
     * @return string|null
     */
    protected function buildScriptTagIfRequired(): ?string{
        if($this->javascriptWasIncluded) {
            return null;
        }

        $this->javascriptWasIncluded = true;
        $url = $this->getJsUrl();

        return '<script type="text/javascript" src="' . $url . '/js/snippet"></script>';
    }

    /**
     * Finds the javascript url to load the snippet source from
     * @return string
     */
    protected function getJsUrl(): string{
        $trimmer = function(string $url): string {
            return rtrim(trim($url, '/ '));
        };

        if(defined('HUR_WEBHUB_PROXY_URL')){
            return $trimmer(HUR_WEBHUB_PROXY_URL);
        }
        $settings = $this->getSiteSettings();
        if(!empty($settings['proxyUrl'])){
            return $trimmer($settings['proxyUrl']);
        }

        return 'https://webhub.huettig-rompf.de';
    }

    /**
     * Generates the snippet configuration JSOn based on the merged plugin configuration
     * @param   array  $siteSettings The merged site and network settings
     *
     * @return array
     */
    protected function buildDynamicSnippetConfiguration(array $siteSettings, array $attr): array{
        $config = [];
        
        if($siteSettings['snippetType'] === 'calcAnnuityWhiteLabel') {
            if (isset($siteSettings['primaryColor'])) {
                $config['style']['loaderColor']       = $siteSettings['primaryColor'];
                $config['formPreset']['primaryColor'] = $siteSettings['primaryColor'];
            }

            if (isset($siteSettings['headline'])) {
                $config['formPreset']['headline'] = $siteSettings['headline'];
            }

            if (isset($siteSettings['subHeadline'])) {
                $config['formPreset']['subHeadline'] = $siteSettings['subHeadline'];
            }

            if (isset($siteSettings['propertyPrice'])) {
                $config['calculatorPreset']['propertyPrice'] = Helper::floatFromString($siteSettings['propertyPrice']);
            }

            if (isset($attr['property-price'])) {
                $price = Helper::floatFromString($attr['property-price']);
                if ($price > 1) {
                    $config['calculatorPreset']['propertyPrice'] = $price;
                }
            }

            if (isset($siteSettings['propertyZip'])) {
                $config['calculatorPreset']['zip'] = $siteSettings['propertyZip'];
            }
            if (isset($attr['property-zip']) && Helper::isZip((string)$attr['property-zip'])) {
                $config['calculatorPreset']['zip'] = $attr['property-zip'];
            }

            if(isset($siteSettings['showLogo']) && $siteSettings['showLogo'] === '0'){
                $config['formPreset']['showLogo'] = false;
            }
            if(isset($siteSettings['inheritFonts']) && $siteSettings['inheritFonts'] === '1'){
                $config['formPreset']['inheritFonts'] = true;
            }
        }

        if($siteSettings['snippetType'] !== '@custom'){
            $config['snippetType'] = $siteSettings['snippetType'];
        }

        $config = $this->mergeRecursive($config, $siteSettings['configuration']);

        // Fall back if no snippet type is present -> This should prevent some nasty issues
        if(empty($config['snippetType'])) {
            $config['snippetType'] = 'calcAnnuityWhiteLabel';
        }

        return $config;
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
