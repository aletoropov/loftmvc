<?php
require_once '../config.php';
require_once ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Application;

$app = new Application();

try {
    $app->run();
} catch (\Core\RouteException $e) {
    echo $e->getMessage();
}
