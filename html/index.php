<?php
include "../vendor/autoload.php";

use Core\Route;

$parts = parse_url($_SERVER['REQUEST_URI']);

$route = new Route();

/** @uses \App\Controller\User::actionLogin() */
$route->addRoute('/user/login', \App\Controller\User::class, 'actionLogin');

/** @uses \App\Controller\User::actionRegister() */
$route->addRoute('/user/register', \App\Controller\User::class, 'actionRegister');

$controllerName = $route->getControllerName();
$controller = new $controllerName;

$actionName = $route->getActionName();
$controller->$actionName();
