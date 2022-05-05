<?php
include "../vendor/autoload.php";

use Core\Application;

$parts = parse_url($_SERVER['REQUEST_URI']);

$app = new Application();
$app->run();
