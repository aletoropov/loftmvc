<?php
require_once "../vendor/autoload.php";
require_once "../config.php";

use Core\Application;

$parts = parse_url($_SERVER['REQUEST_URI']);

$app = new Application();
$app->run();