<?php
/**
 * PSR-4 compatible autoloader for manual installation
 * DO NOT INCLUDE THE FILE IF YOU'RE USING COMPOSER
 */

spl_autoload_register(function ($class) {
    $prefix = 'Automile\\Sdk\\';
    $base_dir = __DIR__ . '/lib/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
