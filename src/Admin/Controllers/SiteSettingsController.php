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
        $post = [
            'snippetType' => $_POST['snippetType'] ?? null,
            'primaryColor' => $_POST['primaryColor'] ?? null,
            'secondaryColor' => $_POST['secondaryColor'] ?? null,
            'configuration' => strip_tags(stripslashes_deep($_POST['configuration'] ?? null)),
            'proxyUrl' => $_POST['proxyUrl'] ?? null,
        ];

        $errors = $this->validate($post);

        $post['network'] = get_site_option('hur_snippets_network_settings', []);

        if (empty($errors)) {
            update_option($this->optionKey, Helper::removeEmpty($post));

            $this->render(array_merge(
                [
                    'success' => true,
                ],
                $post
            ));
            return;
        }

        $this->render(array_merge(
            [
                'errors' => $errors,
            ],
            $post
        ));
    }

    protected function validate($data)
    {
        $errors = [];

        if (array_key_exists('snippetType', $data) &&
            !in_array($data['snippetType'], Helper::snippetTypes(), true)
        ) {
                $errors['snippetType'] = __('Snippet Type is unknown.', 'hur-snippets');
        }

        if (array_key_exists('primaryColor', $data) && !$this->isColor($data['primaryColor'])) {
            $errors['primaryColor'] = __('Primary color is not a valid color.', 'hur-snippets');
        }

        if (array_key_exists('secondaryColor', $data) && !$this->isColor($data['secondaryColor'])) {
            $errors['secondaryColor'] = __('Secondary color is not a valid color.', 'hur-snippets');
        }

        if (array_key_exists('configuration', $data) && !$this->isJson($data['configuration'])) {
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
