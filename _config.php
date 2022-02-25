<?php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $url = "https";
} else {
    $url = "http";
}
$url .= "://";
$url .= $_SERVER['HTTP_HOST'];
define('NAMESERVER', $url);

$url  = $_SERVER['SCRIPT_NAME'];
$urls = explode('/', $url);
$url  = '';
for ($i = 0; $i < (count($urls) - 1); $i++) {
    $url .= $urls[$i] . '/';
}

$path  = $_SERVER['SCRIPT_FILENAME'];
$paths = explode('/', $path);
$path  = '';
for ($i = 0; $i < (count($paths) - 1); $i++) {
    $path .= $paths[$i] . '/';
}
if (strpos($path, 'include/')) {
    $path = str_replace('include/', '', $path);
}
define('PATH', $path);
define('URL', NAMESERVER . $url);
define('ROOT', $url);

// local ou web
//if (stripos(NAMESERVER, '.dev') !== FALSE) {
//    define('TYPE_SERVER', 'local');
//} else {
//    define('TYPE_SERVER', 'web');
//}