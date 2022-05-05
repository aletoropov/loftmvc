<?php

namespace Core;

class Application
{
    private Route $route;
    /** @var AbstractController  */
    private AbstractController $controller;

    /**
     * init Route
     */
    public function __construct()
    {
        $this->route = new Route();
    }

    /**
     * @throws RouteException
     */
    public function run()
    {
        try {
            $this->addRoutes();
            $this->initController();
            $this->initAction();
        } catch (RedirectException $ex) {
            http_response_code(302);
            header('Location: ' . $ex->getUrl());
            exit();
        } catch (RouteException $ex) {
            http_response_code(404);
            echo $ex->getMessage();
            exit();
        }
    }

    /**
     * @return void
     */
    private function addRoutes()
    {
        /** @uses \App\Controller\User::actionLogin() */
        $this->route->addRoute('/user/login', \App\Controller\User::class, 'actionLogin');

        /** @uses \App\Controller\User::actionRegister() */
        $this->route->addRoute('/user/register', \App\Controller\User::class, 'actionRegister');
    }

    /**
     * @return void
     * @throws RouteException
     */
    private function initController()
    {
        $controllerName = $this->route->getControllerName();
        if (!class_exists($controllerName)) {
            throw new RouteException($controllerName . ' - class not found!');
        }
        $this->controller = new $controllerName();
    }

    /**
     * @return void
     * @throws RouteException
     */
    private function initAction()
    {
        $actionName = $this->route->getActionName();
        if (!method_exists($this->controller, $actionName)) {
            throw new RouteException($actionName . ' - action not found! in class: ' . get_class($this->controller));
        }
        $this->controller->$actionName();
    }
}