<?php
include "../vendor/autoload.php";

use Core\Application;

$parts = parse_url($_SERVER['REQUEST_URI']);

switch ($parts['path']) {
    case '/':
        echo 'index';
        break;
    case '/user/login':
        echo 'user login';
        break;
    case '/user/register':
        echo 'user/register';
        break;
    default:
        http_response_code(404);
}
