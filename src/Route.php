<?php

namespace Core;


class Route
{
    /**
     * Контроллер по умолчанию
     *
     * @var string
     */
    private string $controllerName = BASE_CONTROLLER;
    /**
     * Метод контроллера
     *
     * @var string
     */
    private string $actionName;
    /**
     * Автоматический роутинг
     *
     * @var bool
     */
    private bool $processed = false;
    /**
     * Контроллер и метод контроллера
     *
     * @var array
     */
    private array $routes;

    /**
     * Автоматичечкий роутинг, ищет указанный контроллер и метод в нем по URI
     *
     * @return void
     * @throws RouteException
     */
    private function process(): void
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
     * Добавляем роут
     *
     * @param $path
     * @param string $controllerName
     * @param string $actionName
     * @return void
     */
    public function addRoute($path, string $controllerName, string $actionName): void
    {
        $this->routes[$path] = [
            $controllerName,
            $actionName,
        ];
    }

    /**
     * Возвращает имя контроллера
     *
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
     * Возвращает имя метода контроллера
     *
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