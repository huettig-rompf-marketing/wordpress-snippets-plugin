<?php

namespace HuR\Snippets\Admin\Controllers;

use HuR\Snippets\Helper;

class NetworkSettingsController extends AbstractController
{
    protected $template = 'network-settings.php';

    protected $optionKey = 'hur_snippets_network_settings';

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
        $settings = get_site_option($this->optionKey, []);

        $this->render($settings);
    }

    public function save()
    {
        $post = [
            'proxyUrl' => $_POST['proxyUrl'] ?? null,
        ];

        $errors = $this->validate($post);

        if (empty($errors)) {
            update_network_option(null, $this->optionKey, Helper::removeEmpty($post));

            $this->render($post);
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

        if (!empty($data['proxyUrl']) && !$this->isURL($data['proxyUrl'])) {
            $errors['proxyUrl'] = __('Proxy must be a valid URL.', 'hur-snippets');
        }

        return $errors;
    }

    protected function isURL(string $url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    protected function assets(): array
    {
        return [
            [
                'file' => '/bundle/admin.js',
                'hook' => 'only-enqueue-on-this-hook',
                'type' => 'script'
            ],
            [
                'file' => '/bundle/css/admin.css',
                'hook' => 'only-enqueue-on-this-hook',
                'type' => 'style'
            ],
        ];
    }
}
