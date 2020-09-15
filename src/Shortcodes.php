<?php

namespace HuR\Snippets;

use HuR\Snippets\Shortcodes\ShortCodeInterface;
use HuR\Snippets\Shortcodes\SnippetShortcode;

class Shortcodes
{
    public function register()
    {
        add_shortcode('hur_snippet', $this->makeShortCodeIfCallable(new SnippetShortcode()));
    }

    /**
     * Internal helper to register a short code callable which allows only array as $attr
     * @param   \HuR\Snippets\Shortcodes\ShortCodeInterface  $shortCode
     *
     * @return callable
     */
    protected function makeShortCodeIfCallable(ShortCodeInterface $shortCode): callable{
        return static function($attr, string $content) use($shortCode): string{
            return $shortCode->render(is_array($attr) ? $attr : null, $content);
        };
    }
}
