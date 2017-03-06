<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$root = realpath(dirname(__DIR__));
$library = "$root/lib";
$tests = "$root/tests";

$path = array($library, $tests, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $path));

$vendorFilename = $root . '/../../vendor/autoload.php';
if (file_exists($vendorFilename)) {
    /** @noinspection PhpIncludeInspection */
    require $vendorFilename;
} else {
    require $root . '/init.php';
}

spl_autoload_register(function ($class) {
    $prefix = 'Automile\\Sdk\\Tests\\';
    $base_dir = __DIR__ . '/';

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


unset($root, $library, $tests, $path, $vendorFilename);
