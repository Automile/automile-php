<?php

error_reporting(E_ALL | E_STRICT);
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
    require $root . '/autoload.php';
}

unset($root, $library, $tests, $path);
