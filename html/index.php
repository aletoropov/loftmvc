<?php
require_once '../config.php';
require_once ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Core\Application;
use Core\RouteException;

$app = new Application();

try {
    $app->run();
} catch (RouteException $e) {
    exit($e->getMessage());
}
