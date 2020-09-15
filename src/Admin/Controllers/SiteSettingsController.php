<?php

namespace HuR\Snippets\Admin\Controllers;

use HuR\Snippets\Helper;

class SiteSettingsController extends AbstractController
{
    protected $template = 'site-settings.php';

    protected $optionKey = 'hur_snippets_settings';

    public function __invoke()
    {
        if ($this->isPost()) {
            $this->save();
            return;
        }

        $this->view();
    }

    public function view()
    {
        $settings = get_option($this->optionKey, []);
        $settings['network'] = get_site_option('hur_snippets_network_settings', []);
        $this->render($settings);
    }

    public function save()
    {
        $networkSettings = get_site_option('hur_snippets_network_settings', []);

        $post = [
            'snippetType' => $_POST['snippetType'] ?? null,
            'proxyUrl' => $_POST['proxyUrl'] ?? null,
            'configuration' => $_POST['configuration'] ?? null
        ];

        $fields = [];
        if ($post['snippetType'] === 'calcAnnuityWhiteLabel') {
            $fields = ['primaryColor', 'headline', 'subHeadline', 'propertyPrice',
                       'showLogo', 'inheritFonts', 'propertyZip'];
        }

        foreach ($fields as $field){
            $post[$field] = strip_tags(stripslashes_deep($_POST[$field] ?? ''));
        }
        $fields = array_keys($post);

        $errors = $this->validate($post, $fields);

        if (empty($errors)) {
            update_option($this->optionKey, Helper::removeEmpty($post));

            $this->render(array_merge(
                [
                    'success' => true,
                ],
                $post,
                [
                    'network' => $networkSettings
                ]
            ));
            return;
        }

        $this->render(array_merge(
            [
                'errors' => $errors,
            ],
            $post,
            [
                'network' => $networkSettings
            ]
        ));
    }

    protected function validate(array $data, array $fields)
    {
        $errors = [];

        if (in_array('snippetType', $fields, true) &&
            !in_array($data['snippetType'], Helper::snippetTypes(), true)
        ) {
                $errors['snippetType'] = __('Snippet Type is unknown.', 'hur-snippets');
        }

        if (in_array('primaryColor', $fields, true) && $data['primaryColor'] !== '' &&
            !$this->isColor($data['primaryColor'])) {
            $errors['primaryColor'] = __('Primary color is not a valid color.', 'hur-snippets');
        }
        if (in_array('propertyPrice', $fields, true) && $data['propertyPrice'] !== '' &&
            Helper::floatFromString($data['propertyPrice']) < 1) {
            $errors['propertyPrice'] = __('The given price could not be parsed into a float number.', 'hur-snippets');
        }
        if (in_array('propertyZip', $fields, true) && $data['propertyZip'] !== '' &&
            !Helper::isZip($data['propertyZip'])) {
            $errors['propertyZip'] = __('This zip code looks invalid.', 'hur-snippets');
        }

        if (in_array('showLogo', $fields, true) && !in_array($data['showLogo'], ['1', '0'], true)) {
            $errors['showLogo'] = __('Invalid boolean value', 'hur-snippets');
        }
        if (in_array('inheritFonts', $fields, true) && !in_array($data['inheritFonts'], ['1', '0'], true)) {
            $errors['inheritFonts'] = __('Invalid boolean value', 'hur-snippets');
        }

        if (in_array('configuration', $fields, true) && $data['configuration'] !== '' &&
            !$this->isJson($data['configuration'])) {
            $errors['configuration'] = __('Configuration is not a valid JSON.', 'hur-snippets');
        }

        if (array_key_exists('proxyUrl', $data) && !$this->isURL($data['proxyUrl'])) {
            $errors['proxyUrl'] = __('Proxy must be a valid URL.', 'hur-snippets');
        }

        return $errors;
    }

    protected function isColor(string $color): bool
    {
        return 1 === preg_match('/^#([0-9A-Fa-f]{3,6})$/', $color);
    }

    protected function isJSON(string $json): bool
    {
        if (empty($json)) {
            return true;
        }

        return null !== json_decode($json);
    }

    protected function isURL(string $url)
    {
        if (empty($url)) {
            return true;
        }

        return filter_var($url, FILTER_VALIDATE_URL);
    }

    protected function data(): array
    {
        return [
            'snippetTypes' => Helper::snippetTypes(),
        ];
    }

    protected function assets(): array
    {
        return [
            [
                'file' => HUR_SNIPPETS_ASSETS_URL . '/bundle/admin.js',
                'hook' => 'only-enqueue-on-this-hook',
                'type' => 'script'
            ],
            [
                'file' => HUR_SNIPPETS_ASSETS_URL . '/bundle/css/admin.css',
                'hook' => 'only-enqueue-on-this-hook',
                'type' => 'style'
            ],
        ];
    }
}
