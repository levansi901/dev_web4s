<?php

if (!defined('SOURCE_DOMAIN')) {
    define('SOURCE_DOMAIN', dirname(__DIR__));
}

$root_project = dirname(dirname(dirname(__DIR__)));
require $root_project . '/config/requirements.php';

// For built-in server
if (PHP_SAPI === 'cli-server') {
    $_SERVER['PHP_SELF'] = '/' . basename(__FILE__);

    $url = parse_url(urldecode($_SERVER['REQUEST_URI']));
    $file = __DIR__ . $url['path'];
    if (strpos($url['path'], '..') === false && strpos($url['path'], '.') !== false && is_file($file)) {
        return false;
    }
}

require $root_project . '/vendor/autoload.php';

use App\Application;
use Cake\Http\Server;

// Bind your application to the server.
$server = new Server(new Application($root_project . '/config'));

// Run the request/response through the application and emit the response.
$server->emit($server->run());
