<?php

namespace Core;


class Route
{
    private $controllerName = 'blog'; //TODO: сделать базовый контроллер из конфига
    private $actionName;
    private $processed = false;
    private $routes;

    /**
     * @return void
     * @throws RouteException
     */
    private function process()
    {
        if (!$this->processed) {
            $parts = parse_url($_SERVER['REQUEST_URI']);
            $path = $parts['path'];

            if (($route = $this->routes[$path] ?? null) !== null) {
                $this->controllerName = $route[0];
                $this->actionName = $route[1];
            } else {
                $parts = explode('/', $path);
                if (!empty($parts[1])) {
                    $this->controllerName = '\\App\\Controller\\' . ucfirst(strtolower($parts[1]));
                } else {
                    $this->controllerName = '\\App\\Controller\\' . ucfirst(strtolower($this->controllerName));
                }
                if (!empty($parts[2])) {
                    $this->actionName = 'action' . ucfirst(strtolower($parts[2]));
                } else {
                    $this->actionName = 'actionIndex';
                }

                if (!class_exists($this->controllerName)) {
                    throw new RouteException($this->controllerName .  ' - controller not found');
                }
            }
            $this->processed = true;
        }
    }

    /**
     * @param $path
     * @param $controllerName
     * @param $actionName
     * @return void
     */
    public function addRoute($path, $controllerName, $actionName)
    {
        $this->routes[$path] = [
            $controllerName,
            $actionName,
        ];
    }

    /**
     * @return string
     * @throws RouteException
     */
    public function getControllerName(): string
    {
        if (!$this->processed) {
            $this->process();
        }
        return $this->controllerName;
    }

    /**
     * @return string
     * @throws RouteException
     */
    public function getActionName(): string
    {
        if (!$this->processed) {
            $this->process();
        }
        return $this->actionName;
    }
}