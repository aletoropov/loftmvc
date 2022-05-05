<?php

namespace Core;


class Route
{
    private $controllerName;
    private $actionName;
    private $processed = false;
    private $routes;

    private function process()
    {
        $parts = parse_url($_SERVER['REQUEST_URI']);
        $path = $parts['path'];

        if (($route = $this->routes[$path] ?? null) !== null) {
            $this->controllerName = $route[0];
            $this->actionName = $route[1];
        } else {
            $parts = explode('/', $path);
            $this->controllerName = '\\App\\Controller\\' . ucfirst(strtolower($parts[1]));
            if (!empty($parts[2])) {
                $this->actionName = 'action' . ucfirst(strtolower($parts[2]));
            } else {
                $this->actionName = 'actionIndex';
            }

            if (!class_exists($this->controllerName)) {
                throw new RouteException($this->controllerName .  ' - controller not found');
            }
        }
    }

    public function addRoute($path, $controllerName, $actionName)
    {
        $this->routes[$path] = [
            $controllerName,
            $actionName,
        ];
    }

    public function getControllerName(): string
    {
        if (!$this->processed) {
            $this->process();
        }
        return $this->controllerName;
    }

    public function getActionName(): string
    {
        if (!$this->processed) {
            $this->process();
        }
        return $this->actionName;
    }
}