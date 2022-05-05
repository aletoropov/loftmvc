<?php

namespace Core;

abstract class AbstractController
{
    abstract function actionIndex();

    protected function redirect(string $url)
    {
        throw new RedirectException($url);
    }
}