<?php

namespace HuR\Snippets\Admin\Controllers;

abstract class AbstractController
{
    protected $template;

    protected function render(array $data = [], string $template = null)
    {
        $data = array_merge($this->data(), $data);
        $template = $template ?? $this->template;

        ob_start();
        require HUR_SNIPPETS_TEMPLATE_DIR . '/' . ltrim($template, '/');
        echo ob_get_clean();
    }

    protected function isPost(): bool
    {
        return 'POST' === $_SERVER['REQUEST_METHOD'];
    }

    protected function data(): array
    {
        return [];
    }
}
