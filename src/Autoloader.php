<?php

namespace HuR\Snippets;

class Autoloader
{
    protected $namespace;
    protected $path;

    public function register(string $namespace, string $path)
    {
        $this->namespace = rtrim($namespace, '\\') . '\\';
        $this->path = rtrim($path, '/');

        spl_autoload_register([$this, 'autoload']);
    }

    public function autoload($class)
    {
        if (0 !== strpos($class, $this->namespace)) {
            return;
        }

        $file = $this->path . '/' . str_replace('\\', '/', substr($class, strlen($this->namespace))) . '.php';

        $this->requireFile($file);
    }

    protected function requireFile(string $file)
    {
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
