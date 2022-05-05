<?php
include "../vendor/autoload.php";

use App\Controller\User;

$parts = parse_url($_SERVER['REQUEST_URI']);

switch ($parts['path']) {
    case '/':
        echo 'index';
        break;
    case '/user/login':
        $user = new User();
        $user->actionLogin();
        break;
    case '/user/register':
        echo 'user/register';
        break;
    default:
        http_response_code(404);
}
