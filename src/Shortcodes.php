<?php

namespace HuR\Snippets;

use HuR\Snippets\Shortcodes\SnippetShortcode;

class Shortcodes
{
    public function register()
    {
        add_shortcode('hur_snippet', [$this, 'snippetShortcode']);
    }

    public function snippetShortcode($atts, $content): string
    {
        return (new SnippetShortcode())($atts, $content);
    }
}
